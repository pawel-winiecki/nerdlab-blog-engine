<?php

namespace Homepage\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Homepage\BlogBundle\Entity\User;

abstract class DefaultController extends Controller {

    protected function getUserHash(User $user, $useUpdatedOn = false, $usePswRqAt = false) {
        $data = $user->getLogin() . $user->getCreatedOn()->getTimestamp();

        if ($useUpdatedOn) {
            $data = $data . $user->getUpdatedOn()->getTimestamp();
        }

        if ($usePswRqAt) {
            $data = $data . $user->getPasswordRequestedAt()->getTimestamp();
        }

        return hash('sha1', $data);
    }

    protected function DeniedIfCurrentUser($user) {
        if ($user->getUsername() != $this->getUser()->getUsername()) {
            throw new AccessDeniedException('Nie możesz edytować danych innych użytkowników.');
        }
    }

}
