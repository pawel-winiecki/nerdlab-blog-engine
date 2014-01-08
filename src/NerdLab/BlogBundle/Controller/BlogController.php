<?php

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller {

    private $_limit = 5;

    public function indexAction($page, $category = null) {
        $view = array();
        $view['currentPage'] = $page;

        $arguments = array('isActive' => 1);

        if ($category) {
            $view['postsCategory'] = $arguments['postsCategory'] = $this->getDoctrine()
                    ->getRepository('NerdLabBlogBundle:PostsCategory')
                    ->findOneByLink($category);
        }

        $view['posts'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                $arguments, array('createdOn' => 'DESC'), $this->_limit, $page * $this->_limit
        );
        if ($page > 0) {
            $nextPosts = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                    ->findBy(
                    $arguments, null, $this->_limit, ($page - 1) * $this->_limit
            );
        }

        $previousPosts = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                $arguments, null, $this->_limit, ($page + 1) * $this->_limit
        );

        $view['hasPreviousPosts'] = !empty($previousPosts);
        $view['hasNextPosts'] = !empty($nextPosts);

        return $this->render('NerdLabBlogBundle:Blog:index.html.twig', $view);
    }

    public function categoryListAction() {
        $view = array();

        $view['postsCategories'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:PostsCategory')
                ->findBy(
                array('isActive' => 1), array('categoryName' => 'ASC')
        );
        return $this->render('NerdLabBlogBundle:Blog:_categoryList.html.twig', $view);
    }

}
