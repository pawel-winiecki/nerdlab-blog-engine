<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Homepage\BlogBundle\Form\Model;

/**
 * Description of Contact
 *
 * @author Paweł Winiecki
 */
class Message {
    
    private $name;
    private $subject;
    private $email;
    private $content;
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        
        return $this;
    }
    
    public function getSubject() {
        return $this->subject;
    }
    
    public function setSubject($subject) {
        $this->subject = $subject;
        
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        
        return $this;
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function setContent($content) {
        $this->content = $content;
        
        return $this;
    }
    
}
