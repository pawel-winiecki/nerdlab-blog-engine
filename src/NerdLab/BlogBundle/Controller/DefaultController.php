<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use NerdLab\BlogBundle\Entity\User;

/**
 * Abstract controller class with method used in other controllers.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 */
abstract class DefaultController extends Controller {

    /**
     * Create shorter user hash. Not for Security Context.
     * 
     * @access public
     * @param User $user | User object to create hash.
     * @param boolean $useUpdatedOn | using updated on if true. Default = false
     * @param boolean $usePswRqAt | using password require at if true. Default = false
     * @return string | user hash.
     */
    protected function getUserHash(User $user, $useUpdatedOn = false, $usePswRqAt = false) {

        // infomration using to create hash.
        $data = $user->getLogin() . $user->getCreatedOn()->getTimestamp();

        if ($useUpdatedOn) {
            $data = $data . $user->getUpdatedOn()->getTimestamp();
        }

        if ($usePswRqAt) {
            $data = $data . $user->getPasswordRequestedAt()->getTimestamp();
        }

        return hash('sha1', $data);
    }

    /**
     * Method throw 403 exception if param user and user from security context are diffrent.
     * 
     * @access public
     * @param User $user | User for checking with security context.
     * @throw AccessDeniedException
     */
    protected function DeniedIfNotCurrentUser($user) {
        if ($user->getUsername() != $this->getUser()->getUsername()) {
            throw new AccessDeniedException('Nie możesz edytować danych innych użytkowników.');
        }
    }

}
