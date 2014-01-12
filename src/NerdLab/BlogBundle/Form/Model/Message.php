<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Form\Model;

/**
 * Message is data model for contact form. Validation is decribed in validation.yml.
 *
 * @author Paweł Winiecki <pawel.winiecki@nerdlab.pl>
 */
class Message {

    /**
     * @var string | Name of message's author.
     */
    private $name;
    
    /**
     * @var string | Message's subject for email.
     */
    private $subject;
    
    /**
     * @var string | Email of message's author.
     */
    private $email;
    
    /**
     * @var string | Content of sending email.
     */
    private $content;
    
    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return Message
     */
    public function setName($name) {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject() {
        return $this->subject;
    }
    
    /**
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject) {
        $this->subject = $subject;
        
        return $this;
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
     * Set email
     *
     * @param string $email
     * @return Message
     */
    public function setEmail($email) {
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }
    
    /**
     * Set contentl
     *
     * @param string $content
     * @return Message
     */
    public function setContent($content) {
        $this->content = $content;
        
        return $this;
    }
    
}
