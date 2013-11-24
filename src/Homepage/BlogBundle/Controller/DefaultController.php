<?php

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    
    private $_limit = 3;

    public function indexAction($page) {
        $view = array();
        
        //$view['posts'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')->findAll();
        $view['currentPage'] = $page;
        $view['posts'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')
                ->findBy(
                        array('isActive' => 1),
                        array('createdOn' => 'DESC'),
                        $this->_limit,
                        $page * $this->_limit
                        );
        if($page > 0) {
            $previousPosts = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')
                    ->findBy(
                            array('isActive' => 1),
                            null,
                            $this->_limit,
                            ($page-1) * $this->_limit
                            );
        }
                
        $nextPosts = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')
                ->findBy(
                        array('isActive' => 1),
                        null,
                        $this->_limit,
                        ($page+1) * $this->_limit
                        );

        $view['hasPreviousPosts'] = !empty($previousPosts);
        $view['hasNextPosts'] = !empty($nextPosts);
        
        return $this->render('HomepageBlogBundle:Default:index.html.twig', $view);
    }

}
