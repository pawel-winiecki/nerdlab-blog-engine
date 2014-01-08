<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NerdLab\BlogBundle\Form\Model\Message;

/**
 * Description of ContactController
 *
 * @author Paweł Winiecki
 */
class ContactController extends Controller {

    public function contactAction(Request $request) {
        $message = new Message();
        $form = $this->createFormBuilder($message)
                ->setAction($this->generateUrl('nerdlab_blog_contact'))
                ->add('name', 'text', array('label' => 'Imię'))
                ->add('subject', 'text', array('label' => 'Temat'))
                ->add('email', 'email', array('label' => 'Email'))
                ->add('content', 'textarea', array('label' => 'Wiadomość'))
                ->add('save', 'submit', array('label' => 'Wyślij wiadomość'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mail = \Swift_Message::newInstance()
                    ->setSubject($message->getSubject() . ' - Formularz kontaktowy')
                    ->setFrom($message->getEmail())
                    ->setTo('kontakt@nerdlab.pl')
                    ->setBody(
                    $this->renderView('NerdLabBlogBundle:Contact:contactEmail.html.twig', array(
                        'name' => $message->getName(),
                        'content' => nl2br(strip_tags($message->getContent())))), 'text/html');
            $this->get('mailer')->send($mail);

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Wiadomość została wysłana.'
            );

            return $this->redirect($this->generateUrl('nerdlab_blog_index'));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = 'Kontakt';

        return $this->render('NerdLabBlogBundle:Contact:contact.html.twig', $view);
    }

}
