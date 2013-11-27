<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Homepage\BlogBundle\Entity\User;

/**
 * Description of UesrController
 *
 * @author Paweł Winiecki
 */
class UserController extends DefaultController {

    public function indexAction($login) {
        $view = array();

        $view['user'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);

        $view['isUser'] = $view['user']->getUsername() == $this->getUser()->getUsername();

        return $this->render('HomepageBlogBundle:User:viewUser.html.twig', $view);
    }

    public function createAction(Request $request) {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }

        $user = new User();

        $view = array();

        $form = $this->createFormBuilder($user)
                ->setAction($this->generateUrl('homepage_blog_user_create'))
                ->add('login', 'text')
                ->add('firstName', 'text', array('required' => false))
                ->add('lastName', 'text', array('required' => false))
                ->add('password', 'password')
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'required' => true,
                    'first_options' => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('email', 'repeated', array(
                    'type' => 'email',
                    'invalid_message' => 'The email fields must match.',
                    'required' => true,
                    'first_options' => array('label' => 'Email'),
                    'second_options' => array('label' => 'Repeat Email'),
                ))
                ->add('save', 'submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedOn(new \DateTime());
            $user->setPassword(hash('sha512', $user->getPassword()));
            $user->setIsActive(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->sendWelcomeEmail($user);

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Dziękujemy za założenie konta. Na adres ' . $user->getEmail() . ' została wysłana
    wiadomość z linkiem aktywacyjnym. Kliknij go aby w pełni aktywować konto.'
            );

            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }

        $view['form'] = $form->createView();
        $view['user'] = $user;

        return $this->render('HomepageBlogBundle:User:createUser.html.twig', $view);
    }

    public function activateAction(Request $request) {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('homepage_blog_index'));
        }

        $login = $request->query->get('login');

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);
        if (is_null($user)) {
            throw $this->createNotFoundException();
        }

        $hash = $this->getUserHash($user);
        $key = $request->query->get('key');

        if ($key == $hash) {
            $user->addRoleRole($this->getDoctrine()->getRepository('HomepageBlogBundle:Role')->findOneByRoleName('ROLE_USER'));
            $user->setIsActive(1);
            $user->setUpdatedOn(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $view = array();
            $view['user'] = $user;

            $this->get('session')->getFlashBag()->add(
                    'pdatedOn', 'Konto zostało aktywowane. Możesz się zalogować.'
            );

            return $this->redirect($this->generateUrl('login'));
        } else {
            throw $this->createNotFoundException();
        }
    }

    public function editAction(Request $request, $login) {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);

        $this->DeniedIfCurrentUser($user);

        $view = array();

        $form = $this->createFormBuilder($user)
                ->setAction($this->generateUrl('homepage_blog_user_edit', array('login' => $user->getUsername())))
                ->add('firstName', 'text', array('required' => false))
                ->add('lastName', 'text', array('required' => false))
                ->add('email', 'email')
                ->add('save', 'submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $user->setUpdatedOn(new \DateTime());
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                        'success-notice', 'Zmiany zostały zapisane'
                );

                return $this->redirect($this->generateUrl('homepage_blog_user_view', array('login' => $user->getUsername())));
            }
        }

        $view['form'] = $form->createView();
        $view['user'] = $user;

        return $this->render('HomepageBlogBundle:User:editUser.html.twig', $view);
    }

    private function sendWelcomeEmail(User $user) {
        $view = array();
        $view['login'] = $user->getLogin();
        $view['key'] = $this->getUserHash($user);

        $message = \Swift_Message::newInstance()
                ->setSubject('Mail powitalny')
                ->setFrom('rejestracja@winiecki.com')
                ->setTo($user->getEmail())
                ->setBody(
                $this->renderView('HomepageBlogBundle:User:welcomeEmail.txt.twig', $view));
        $this->get('mailer')->send($message);
    }

}
