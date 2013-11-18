<?php

namespace Homepage\BlogBundle\Controller;

use Homepage\BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $view = array();
        
        $view['posts'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')->findAll();
        
        return $this->render('HomepageBlogBundle:Default:index.html.twig', $view);
    }

}
