<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Controller for handlig login actions.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 *
 */
class SecurityController extends Controller {
    
    /**
     * Displays and handles login form. 
     * 
     * @access public
     * @param Request $request | Request object is used for collect data from login form.
     * @return Response | Renders view NerdLabBlogBundle:Security:login.html.twig
     */
    public function loginAction(Request $request) {
        
        // log in user cant' log again.
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('nerdlab_blog_index'));
        }
        
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        $view = array();
        $view['last_username'] = $session->get(SecurityContext::LAST_USERNAME);
        $view['error'] = $error;
        
        return $this->render('NerdLabBlogBundle:Security:login.html.twig',$view);        
    }
}
