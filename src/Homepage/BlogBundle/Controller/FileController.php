<?php

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Homepage\BlogBundle\Entity\ImageFile;

class FileController extends Controller {

    public function uploadImageAction(Request $request) {

        $imageFile = new ImageFile();
        $form = $this->createFormBuilder($imageFile)
                ->add('name')
                ->add('file')
                ->add('save', 'submit',array('label' => 'Załaduj plik'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $imageFile->setCreatedOn(new \DateTime());

            $em->persist($imageFile);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Obrazek Pomyślnie załadowany'
            );

            return $this->redirect($this->generateUrl('homepage_blog_upload_image'));
        }

        $view['form'] = $form->createView();
        $view['legend'] = "Załaduj plik";

        return $this->render('HomepageBlogBundle:File:image-file.html.twig', $view);
    }

}
