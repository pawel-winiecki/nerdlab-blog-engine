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
                ->add('firstName', 'text', array('required'=>false))
                ->add('lastName', 'text', array('required'=>false))
                ->add('email', 'email')
                ->add('save', 'submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $editedUser->setUptadedOn(new \DateTime());
                $em->flush();

                return $this->redirect($this->generateUrl('homepage_blog_user_view', array('login' => $editedUser->getUsername())));
            } else {
                
            }
            
        }
        
        $view['form'] = $form->createView();
        $view['user'] = $editedUser;

        return $this->render('HomepageBlogBundle:User:editUser.html.twig', $view);
    }

}
