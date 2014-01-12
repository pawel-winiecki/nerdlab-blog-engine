<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NerdLab\BlogBundle\Entity\Comment;
use NerdLab\BlogBundle\Entity\Post;

/**
 * Controller for handlig post actions.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 *
 */
class PostController extends Controller {

    /**
     * Display post page and handle 'add comment' form.
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from 'add comment' form.
     * @param string $link | slug of post.
     * @return Response | Renders view NerdLabBlogBundle:Post:post.html.twig
     */
    public function showPostAction(Request $request, $link) {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('NerdLabBlogBundle:Post')->findOneByLink($link);

        $comment = new Comment();
        $form = $this->createCommentForm($comment, $link);

        $form->handleRequest($request);

        if ($this->get('security.context')->isGranted('ROLE_USER') && $form->isSubmitted() && $form->isValid()) {
            $comment->setContent(nl2br(strip_tags($comment->getContent())));
            $comment->setPost($post);
            $comment->setUser($this->getUser());
            $comment->setIsActive(1);
            $comment->setCreatedOn(new \DateTime());

            $em->persist($comment);
            $em->flush();

            $form = $this->createCommentForm(new Comment(), $link);

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Dziękujemy za dodanie komentarza.'
            );
        }
        $view = array();
        $view['comments'] = $this->getDoctrine()
                ->getRepository('NerdLabBlogBundle:Comment')
                ->findBy(array('post' => $post, 'isActive' => 1));
        $view['form'] = $form->createView();
        $view['post'] = $post;

        return $this->render('NerdLabBlogBundle:Post:post.html.twig', $view);
    }

    /**
     * Displays and handling create post form.
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from create post form.
     * @return mixed | Rendering create post page view or redirect to post page with communicate.
     */
    public function createPostAction(Request $request) {
        $post = new Post();
        $form = $this->createPostForm($post, $this->generateUrl('nerdlab_blog_post_create'), 'Stwórz post');

        $form->handleRequest($request);

        if ($this->get('security.context')->isGranted('ROLE_AUTHOR') && $form->isSubmitted() && $form->isValid()) {
            $post->setUser($this->getUser());
            if (empty($post->getShortContent())) {
                $post->setShortContent(substr(trim(strip_tags($post->getLongContent())), 0, 200));
            }
            $post->setCreatedOn(new \DateTime());
            $post->generateLinkFromTitle();

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Post pomyślnie dodany.'
            );

            return $this->redirect($this->generateUrl('nerdlab_blog_post', array('link' => $post->getLink())));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = 'Stworzenie nowego postu';
        $view['post'] = $post;

        $view['images'] = $this->createImagesCollection();

        return $this->render('NerdLabBlogBundle:Post:editPost.html.twig', $view);
    }

    /**
     * Displays and handling create post form.
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from create post form.
     * @param string $link | slug of post.
     * @return mixed | Rendering create post page view or redirect to post page with communicate.
     */
    public function editPostAction(Request $request, $link) {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('NerdLabBlogBundle:Post')->findOneByLink($link);

        $form = $this->createPostForm($post, $this->generateUrl('nerdlab_blog_post_edit', array('link' => $link)), 'Edytuj post');

        $form->handleRequest($request);

        if ($this->get('security.context')->isGranted('ROLE_AUTHOR') && $form->isSubmitted() && $form->isValid()) {
            $post->generateLinkFromTitle();

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Post pomyślnie zmieniony.'
            );

            return $this->redirect($this->generateUrl('nerdlab_blog_post', array('link' => $post->getLink())));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = 'Edycja postu';
        $view['post'] = $post;

        $view['images'] = $this->createImagesCollection();

        return $this->render('NerdLabBlogBundle:Post:editPost.html.twig', $view);
    }

    /**
     * Displays list of newest post.
     * 
     * @access public
     * @param integer $max | number of newest posts to show.
     * @return Response | Renders view NerdLabBlogBundle:Post:_latestPosts.html.twig
     */
    function latestPostsAction($max) {
        $view = array();

        $view['posts'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Post')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $max
        );

        return $this->render('NerdLabBlogBundle:Post:_latestPosts.html.twig', $view);
    }

    /**
     * Displays list of newest comments.
     * 
     * @access public
     * @param integer $max | number of newest comments to show.
     * @return Response | Renders view NerdLabBlogBundle:Post:_latestComments.html.twig
     */
    function latestCommentsAction($max) {
        $view = array();

        $view['comments'] = $this->getDoctrine()->getRepository('NerdLabBlogBundle:Comment')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $max
        );

        return $this->render('NerdLabBlogBundle:Post:_latestComments.html.twig', $view);
    }

    /**
     * create form for create/editin post.
     * 
     * @access public
     * @param Post $post | object for creating post.
     * @param string $actionUrl | url for action.
     * @param string $label | text to show on submit button.
     * @return Symfony\Component\Form\Form | form for creating/edit post.
     */
    private function createPostForm(Post $post, $actionUrl, $label) {
        return $this->createFormBuilder($post)
                        ->setAction($actionUrl)
                        ->add('title', 'text', array('label' => 'Tytuł'))
                        ->add('isActive', 'checkbox', array('required' => false, 'label' => 'Opublikowany'))
                        ->add('postsCategory', 'entity', array(
                            'label' => 'Kategoria',
                            'class' => 'NerdLabBlogBundle:PostsCategory',
                            'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                                ->orderBy('g.categoryName', 'ASC')
                                ->where('g.isActive = 1');
                    },))
                        ->add('imageFile', 'entity', array(
                            'required' => false,
                            'label' => 'Miniaturka',
                            'class' => 'NerdLabBlogBundle:ImageFile',
                            'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('f')
                                ->orderBy('f.name', 'ASC');
                    },))
                        ->add('shortContent', 'textarea', array('label' => 'Krótka treść'))
                        ->add('longContent', 'textarea', array('required' => false, 'label' => 'Pełna treść'))
                        ->add('save', 'submit', array('label' => $label))
                        ->getForm();
    }

    /**
     * Displays list of newest comments.
     * 
     * @access public
     * @param Comment $comment | object for creating comment.
     * @param string $actionUrl | url for action.
     * @return Symfony\Component\Form\Form | form for creating comment.
     */
    private function createCommentForm(Comment $comment, $link) {
        return $this->createFormBuilder($comment)
                        ->setAction($this->generateUrl('nerdlab_blog_post', array('link' => $link)))
                        ->add('content', 'textarea', array('attr' => array('placeholder' => 'Skomentuj...', 'title' => 'Skomentuj...')))
                        ->add('save', 'submit', array('label' => 'Dodaj komentarz'))
                        ->getForm();
    }

    /**
     * create array of all uploaded images.
     * 
     * @access public
     * @return array | The uploaded images.
     */
    private function createImagesCollection() {
        return $this->getDoctrine()->getRepository('NerdLabBlogBundle:ImageFile')->findAll();
    }

}
