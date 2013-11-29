<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Homepage\BlogBundle\Entity\Comment;
use Homepage\BlogBundle\Entity\Post;

/**
 * Description of PostsController
 *
 * @author Paweł Winiecki
 */
class PostController extends Controller {

    public function showPostAction(Request $request, $link) {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('HomepageBlogBundle:Post')->findOneByLink($link);

        $comment = new Comment();
        $form = $this->createCommentForm($comment, $link);

        $form->handleRequest($request);

        if ($this->get('security.context')->isGranted('ROLE_USER') && $form->isSubmitted() && $form->isValid()) {
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
                ->getRepository('HomepageBlogBundle:Comment')
                ->findBy(array('postPost' => $post, 'isActive' => 1));
        $view['form'] = $form->createView();
        $view['post'] = $post;

        return $this->render('HomepageBlogBundle:Post:post.html.twig', $view);
    }

    public function createPostAction(Request $request) {
        $post = new Post();
        $form = $this->createPostForm($post, $this->generateUrl('homepage_blog_post_create'), 'Stwórz post');

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

            return $this->redirect($this->generateUrl('homepage_blog_post', array('link' => $post->getLink())));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = 'Stworzenie nowego postu';
        $view['post'] = $post;

        return $this->render('HomepageBlogBundle:Post:editPost.html.twig', $view);
    }

    public function editPostAction(Request $request, $link) {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('HomepageBlogBundle:Post')->findOneByLink($link);

        $form = $this->createPostForm($post, $this->generateUrl('homepage_blog_post_edit', array('link' => $link)), 'Edytuj post');

        $form->handleRequest($request);

        if ($this->get('security.context')->isGranted('ROLE_AUTHOR') && $form->isSubmitted() && $form->isValid()) {
            $post->generateLinkFromTitle();

            $em->flush();

            $this->get('session')->getFlashBag()->add(
                    'success-notice', 'Post pomyślnie zmieniony.'
            );

            return $this->redirect($this->generateUrl('homepage_blog_post', array('link' => $post->getLink())));
        }

        $view = array();
        $view['form'] = $form->createView();
        $view['legend'] = 'Edycja postu';
        $view['post'] = $post;

        return $this->render('HomepageBlogBundle:Post:editPost.html.twig', $view);
    }

    function latestPostsAction($max) {
        $view = array();

        $view['posts'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Post')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $max
        );

        return $this->render('HomepageBlogBundle:Post:latestPosts.html.twig', $view);
    }

    function latestCommentsAction($max) {
        $view = array();

        $view['comments'] = $this->getDoctrine()->getRepository('HomepageBlogBundle:Comment')
                ->findBy(
                array('isActive' => 1), array('createdOn' => 'DESC'), $max
        );

        return $this->render('HomepageBlogBundle:Post:latestComments.html.twig', $view);
    }

    private function createPostForm(Post $post, $actionUrl, $label) {
        return $this->createFormBuilder($post)
                        ->setAction($actionUrl)
                        ->add('title', 'text')
                        ->add('isActive', 'checkbox')
                        ->add('postsCategoryPostsCategory', 'entity', array(
                            'class' => 'HomepageBlogBundle:PostsCategory',
                            'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                                ->orderBy('g.categoryName', 'ASC')
                                ->where('g.isActive = 1');
                    },))
                        ->add('shortContent', 'textarea')
                        ->add('longContent', 'textarea')
                        ->add('save', 'submit', array('label' => $label))
                        ->getForm();
    }

    private function createCommentForm(Comment $comment, $link) {
        return $this->createFormBuilder($comment)
                        ->setAction($this->generateUrl('homepage_blog_post', array('link' => $link)))
                        ->add('content', 'textarea')
                        ->add('save', 'submit', array('label' => 'Dodaj komentarz'))
                        ->getForm();
    }

}
