<?php

namespace Homepage\BlogBundle\Controller;

use Homepage\BlogBundle\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        $view = array();
        
        $view['posts'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Posts')->findAll();
        
        return $this->render('HomepageBlogBundle:Default:index.html.twig', $view);
    }

}
