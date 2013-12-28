<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Controller;

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Homepage\BlogBundle\Entity\User;
use Homepage\BlogBundle\Form\Model\ChangePassword;
use Homepage\BlogBundle\Form\Model\ForgottenPassword;

/**
 * Description of PasswordController
 *
 * @author Paweł Winiecki
 */
class PasswordController extends DefaultController {

    public function changePswAction(Request $request, $login) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);

        $this->DeniedIfCurrentUser($user);

        $password = new ChangePassword();

        $form = $this->createFormBuilder($password)
                ->setAction($this->generateUrl('homepage_blog_psw_edit', array('login' => $user->getUsername())))
                ->add('oldPassword', 'password', array('label' => 'Stare hasło'))
                ->add('newPassword', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'required' => true,
                    'first_options' => array('label' => 'Nowe hasło'),
                    'second_options' => array('label' => 'Powtórz nowe hasło'),
                ))
                ->add('save', 'submit', array('label' => 'Zmień hasło'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);

            $user->setUpdatedOn(new \DateTime());

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Hasło zostało zmienione'
            );

            return $this->redirect($this->generateUrl('homepage_blog_user_view', array('login' => $user->getUsername())));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['user'] = $user;

        return $this->render('HomepageBlogBundle:Password:changePsw.html.twig', $view);
    }

    public function forgottenPswAction(Request $request) {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }

        $view = array();

        $forgottenPassword = new ForgottenPassword();

        $form = $this->createFormBuilder($forgottenPassword)
                ->setAction($this->generateUrl('homepage_blog_psw_forgotten'))
                ->add('login', 'text')
                ->add('email', 'email')
                ->add('save', 'submit', array('label' => 'Resetuj hasło'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('HomepageBlogBundle:User')
                    ->findOneBy(array('login' => $forgottenPassword->getLogin(), 'email' => $forgottenPassword->getEmail()));

            if (empty($user)) {
                $form->addError(new FormError('Podałeś zły login i/lub email.'));
            } else {
                $user->setPasswordRequestedAt(new \DateTime());
                $user->setUpdatedOn(new \DateTime());

                $em->flush();

                $this->sendResetPswEmail($user);

                $this->get('session')->getFlashBag()->add(
                        'success-notice', 'Link który pozowli zmienić hasło został wysłany na adres ' . $user->getEmail() . ' Link będzie aktywny przez 24 godziny.'
                );

                return $this->redirect($this->generateUrl('homepage_blog_index'));
            }
        }

        $view['form'] = $form->createView();

        return $this->render('HomepageBlogBundle:Password:forgottenPsw.html.twig', $view);
    }

    public function resetPswAction(Request $request) {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }

        $login = $request->query->get('login');

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository = $this->getDoctrine()->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);
        if (is_null($user)) {
            throw $this->createNotFoundException();
        }

        $hash = $this->getUserHash($user, true, true);
        $key = $request->query->get('key');

        if ($key == $hash) {
            $now = new \DateTime();
            $requested = $user->getPasswordRequestedAt();
            $diff = floor($now - $requested) / 3600;

            if ($diff > 24) {
                $this->get('session')->getFlashBag()->add(
                        'error-notice', 'Link, który użyłeś był przeterminowany.'
                );

                return $this->redirect($this->generateUrl('homepage_blog_index'));
            }

            $form = $this->createFormBuilder($user)
                    ->setAction($this->generateUrl('homepage_blog_psw_reset', array('login' => $user->getUsername(), 'key' => $key)))
                    ->add('plainPassword', 'repeated', array(
                        'type' => 'password',
                        'invalid_message' => 'Hasło musi być takie same',
                        'required' => true,
                        'first_options' => array('label' => 'Hasło'),
                        'second_options' => array('label' => 'Powtórz hasło'),
                    ))
                    ->add('save', 'submit', array('label' => 'Zmień hasło'))
                    ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $factory = $this->get('security.encoder_factory');

                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
                $user->setPassword($password);

                $user->setUpdatedOn(new \DateTime());
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                        'success-notice', 'Hasło zostało zmienione. Możesz się zalogować.'
                );

                return $this->redirect($this->generateUrl('login'));
            }

            $view = array();
            $view['form'] = $form->createView();

            return $this->render('HomepageBlogBundle:Password:resetPsw.html.twig', $view);
        } else {
            $this->get('session')->getFlashBag()->add(
                    'error-notice', 'Link, który użyłeś był nieprawidłowy.'
            );

            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }
    }

    private function sendResetPswEmail(User $user) {
        $view = array();
        $view['login'] = $user->getLogin();
        $view['key'] = $this->getUserHash($user, true, true);

        $message = \Swift_Message::newInstance()
                ->setSubject('Reset hasła')
                ->setFrom('password@winiecki.com')
                ->setTo($user->getEmail())
                ->setBody(
                $this->renderView('HomepageBlogBundle:Password:resetPswEmail.txt.twig', $view));
        $this->get('mailer')->send($message);
    }

}
