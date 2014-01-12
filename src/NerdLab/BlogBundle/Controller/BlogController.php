<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for main and category pages.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 *
 */
class BlogController extends Controller {

    /**
     * @var int | Number of post to show on one page.
     */
    private $_limit = 5;

    /**
     * Displays main blog page if $category is null otherwise displays category page.
     * Displayed blog entries list is limited by $_limit value.
     * 
     * @access public
     * @param int $page | Default = 0
     * @param string $category | Default = null, category slug
     * @return Response | Renders view NerdLabBlogBundle:Blog:index.html.twig
     */
    public function indexAction($page, $category = null) {

        // Set empty array of parameters that will be passed to view
        $view = array();

        // set current page number to view
        $view['currentPage'] = $page;

        // array of arguments for doctrine query, only active posts should be shown
        $arguments = array('isActive' => 1);

        if ($category) {
            // adding category object to view
            $view['postsCategory'] = $this->getDoctrine()
                    ->getRepository('NerdLabBlogBundle:PostsCategory')
                    ->findOneByLink($category);
            $arguments['postsCategory'] = $view['postsCategory'];
        }

        // quring active posts (form category if set), 
        // using ($page -1) for 1-based pages
        $view['posts'] = $this->getDoctrine()
                ->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                $arguments, array('createdOn' => 'DESC'), $this->_limit, ($page - 1) * $this->_limit
        );
        
        if ($page > 1) {
            // checking if previous page exist
            $nextPosts = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                    ->findBy(
                    $arguments, null, $this->_limit, ($page - 2) * $this->_limit
            );
        }

        // checking if previous page exist
        $previousPosts = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                $arguments, null, $this->_limit, $page * $this->_limit
        );

        // setting information about previous and next page for view.
        $view['hasPreviousPosts'] = !empty($previousPosts);
        $view['hasNextPosts'] = !empty($nextPosts);

        return $this->render('NerdLabBlogBundle:Blog:index.html.twig', $view);
    }

    /**
     * Displays list of categories as a part of other page.
     * 
     * @access public
     * @return Response | Renders view NerdLabBlogBundle:Blog:_categoryList.html.twig
     */
    public function categoryListAction() {
        $view = array();

        $view['postsCategories'] = $this->getDoctrine()
                ->getRepository('NerdLabBlogBundle:PostsCategory')
                ->findBy(
                array('isActive' => 1), array('categoryName' => 'ASC')
        );
        return $this->render('NerdLabBlogBundle:Blog:_categoryList.html.twig', $view);
    }

}
