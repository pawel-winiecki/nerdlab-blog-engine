<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of PostsController
 *
 * @author Paweł Winiecki
 */
class PostController extends Controller {

    public function showPostAction($link) {
        $view = array();
        
        $view['post'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')->findOneByLink($link);
        
        return $this->render('HomepageBlogBundle:Post:post.html.twig', $view);
    }

}