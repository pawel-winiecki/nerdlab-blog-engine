<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NerdLab\BlogBundle\Form\Model\Message;

/**
 * ContactController handling contact form and send email with message
 * to kontakt@nerdlab.pl
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 */
class ContactController extends Controller {

    /**
     * Displays main blog page if $category is null otherwise displays category page.
     * Displayed blog entries list is limited by $_limit value.
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from form.
     * @return mixed | Rendering contact page view or redirect to main page if send email.
     */
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

        // checking for valid (validation is describe in validation.yml) submited form
        if ($form->isSubmitted() && $form->isValid()) {
            
            // creating mail to send
            $mail = \Swift_Message::newInstance()
                    ->setSubject($message->getSubject() . ' - Formularz kontaktowy')
                    ->setFrom($message->getEmail())
                    ->setTo('kontakt@nerdlab.pl')
                    ->setBody(
                    $this->renderView('NerdLabBlogBundle:Contact:contactEmail.html.twig', array(
                        'name' => $message->getName(),
                        'content' => nl2br(strip_tags($message->getContent())))), 'text/html');
            $this->get('mailer')->send($mail);

            // adding succes message to show on main page
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
