<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of XmlGeneratorController
 *
 * @author Paweł Winiecki
 */
class XmlGeneratorController extends Controller {
    
    private $_rssPageOffset = 5;
    
    public function rssAction() {
        $view = array();
        
        $view['posts'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $this->_rssPageOffset
        );
        
        return $this->render('NerdLabBlogBundle:XmlGenerator:rss.xml.twig', $view);
    }
    
}
