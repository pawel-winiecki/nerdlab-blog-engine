<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Form\Model;

/**
 * ForgottenPassword is data model for forgotten password form. Validation is decribed in validation.yml.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 */
class ForgottenPassword {
    
    /**
     * @var string | login of user
     */
    private $login;
    
    /**
     * @var string | email of user
     */
    private $email;
    
    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * Set login
     *
     * @param string $login
     * @return ForgottenPassword
     */
    public function setLogin($login) {
        $this->login = $login;
    }
    
    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * Set emai
     *
     * @param string $emai
     * @return ForgottenPassword
     */
    public function setEmail($email) {
        $this->email = $email;
    }
}
