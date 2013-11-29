<?php

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller {
    
    private $_limit = 3;

    public function indexAction($page, $category = null) {
        $view = array();
        $view['currentPage'] = $page;
        
        if($category) {
            
        }
        
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
        
        return $this->render('HomepageBlogBundle:Blog:index.html.twig', $view);
    }
    
    public function categoryListAction() {
        $view = array();

        $view['postsCategories'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:PostsCategory')
                ->findBy(
                        array('isActive' => 1),
                        array('categoryName' => 'ASC')
                        );
        return $this->render('HomepageBlogBundle:Blog:categoryList.html.twig', $view);
    }

}
