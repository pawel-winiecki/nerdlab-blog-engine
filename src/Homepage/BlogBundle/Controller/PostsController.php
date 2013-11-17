<?php

namespace Homepage\BlogBundle\Controller;

use Homepage\BlogBundle\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostsController extends Controller {

    public function showPostAction($link) {
        $view = array();
        
        $view['post'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Posts')->findOneByLink($link);
        
        return $this->render('HomepageBlogBundle:Posts:post.html.twig', $view);
    }

}