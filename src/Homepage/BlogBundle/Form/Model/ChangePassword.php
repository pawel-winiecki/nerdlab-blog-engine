<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Form\Model;

/**
 * Description of ChangePassword
 *
 * @author Paweł Winiecki
 */
class ChangePassword {
    protected $oldPassword;
    
    protected $newPassword;
    
    public function getOldPassword() {
        return $this->oldPassword;
    }
    
    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
    }
    
   public function getNewPassword() {
        return $this->newPassword;
    }
    
    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
    }
    
}
