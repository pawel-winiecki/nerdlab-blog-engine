<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for generating and display XML files.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 *
 */
class XmlGeneratorController extends Controller {
    
    /**
     * @var int | Number of post to show in RSS channel.
     */
    private $_rssPageOffset = 5;
    
    /**
     * Displays XML for RSS chanell .
     * 
     * @access public
     * @return Response | Renders view NerdLabBlogBundle:XmlGenerator:rss.xml.twig
     */
    public function rssAction() {
       
        $view = array();      
        $view['posts'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $this->_rssPageOffset
        );
        
        return $this->render('NerdLabBlogBundle:XmlGenerator:rss.xml.twig', $view);
    }
    
}
