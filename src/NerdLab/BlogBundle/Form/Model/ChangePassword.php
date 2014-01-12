<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Form\Model;

/**
 * ChangePassword is data model for change password form. Validation is decribed in validation.yml.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 */
class ChangePassword {
    
    /**
     * @var string | property to valid with user password
     */
    protected $oldPassword;
    
    /**
     * @var string | new password to set.
     */
    protected $newPassword;
    
    /**
     * Get oldPassword
     *
     * @return string 
     */
    public function getOldPassword() {
        return $this->oldPassword;
    }
    
    /**
     * Set oldPassword
     *
     * @param string $oldPassword
     * @return ChangePassword
     */
    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
        
        return $this;
    }
    
   /**
     * Get newPassword
     *
     * @return string 
     */
   public function getNewPassword() {
        return $this->newPassword;
    }
    
    /**
     * Set newPassword
     *
     * @param string $newPassword
     * @return ChangePassword
     */
    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
        
        return $this;
    }
    
}
