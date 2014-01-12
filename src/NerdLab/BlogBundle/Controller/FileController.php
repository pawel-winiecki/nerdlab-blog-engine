<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NerdLab\BlogBundle\Entity\ImageFile;

/**
 * Controller for managin image files.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 *
 */
class FileController extends Controller {

    /**
     * Create and handling form for uploading image files.
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from upload form.
     * @return mixed | Rendering contact page view or redirect to main page if send email.
     */
    public function uploadImageAction(Request $request) {

        $imageFile = new ImageFile();
        $form = $this->createFormBuilder($imageFile)
                ->add('name')
                ->add('file')
                ->add('save', 'submit', array('label' => 'Załaduj plik'))
                ->getForm();

        $form->handleRequest($request);

        // checking for valid (validation is describe in validation.yml) submited form
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $imageFile->setCreatedOn(new \DateTime());

            $em->persist($imageFile);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Obrazek Pomyślnie załadowany'
            );

            return $this->redirect($this->generateUrl('nerdlab_blog_upload_image'));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = "Załaduj plik";

        return $this->render('NerdLabBlogBundle:File:image-file.html.twig', $view);
    }

}
