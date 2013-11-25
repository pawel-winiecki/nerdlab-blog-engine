<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Homepage\BlogBundle\Entity\User;

/**
 * Description of UesrController
 *
 * @author Paweł Winiecki
 */
class UserController extends Controller {

    public function indexAction($login) {
        $view = array();

        $view['user'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);

        $view['isUser'] = $view['user']->getUsername() == $this->getUser()->getUsername();

        return $this->render('HomepageBlogBundle:User:viewUser.html.twig', $view);
    }

    public function createAction(Request $request) {
        $user = new User();

        if (true === $this->get('security.context')->isGranted('ROLE_USER')) {
            throw new AccessDeniedException();
        }

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

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $user->setCreatedOn(new \DateTime());
                $user->setPassword(hash('sha512', $user->getPassword()));
                $user->setIsActive(0);

                //$em = $this->getDoctrine()->getManager();
                //$em->persist($user);
                //$em->flush();

                $this->sendWelcomeEmail($user);

                $view['user'] = $user;

                return $this->render('HomepageBlogBundle:User:waitForMail.html.twig', $view);
            }
        }

        $view['form'] = $form->createView();
        $view['user'] = $user;

        return $this->render('HomepageBlogBundle:User:createUser.html.twig', $view);
    }

    public function activateAction(Request $request) {
        $login = $request->query->get('login');

        $user = $this->getDoctrine()->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);
        if (is_null($user)) {
            throw $this->createNotFoundException();
        }

        $hash = $this->getUserHash($user);
        $key = $request->query->get('key');

        if ($key == $hash) {
            $user->setIsActive(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $view = array();
            $view['user'] = $user;

            return $this->render('HomepageBlogBundle:User:activasionSuccess.html.twig', $view);
        } else {
            throw $this->createNotFoundException();
        }
    }

    public function editAction(Request $request, $login) {

        $em = $this->getDoctrine()->getManager();

        $editedUser = $em->getRepository('HomepageBlogBundle:User')->findOneByLogin($login);
        $sessionUsername = $this->getUser()->getUsername();

        if ($editedUser->getUsername() != $sessionUsername) {
            throw new AccessDeniedException('Nie możesz edytować danych innych użytkowników.');
        }

        $view = array();

        $form = $this->createFormBuilder($editedUser)
                ->setAction($this->generateUrl('homepage_blog_user_edit', array('login' => $editedUser->getUsername())))
                ->add('firstName', 'text', array('required' => false))
                ->add('lastName', 'text', array('required' => false))
                ->add('email', 'email')
                ->add('save', 'submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $editedUser->setUptadedOn(new \DateTime());
                $em->flush();

                return $this->redirect($this->generateUrl('homepage_blog_user_view', array('login' => $editedUser->getUsername())));
            }
        }

        $view['form'] = $form->createView();
        $view['user'] = $editedUser;

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

    private function getUserHash(User $user) {
        return hash('sha512', $user->getLogin() + $user->getCreatedOn()->getTimestamp());
    }

}
