<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $commentId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var \DateTime
     */
    private $updatedOn;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var \Homepage\BlogBundle\Entity\User
     */
    private $userUser;

    /**
     * @var \Homepage\BlogBundle\Entity\Post
     */
    private $postPost;


    /**
     * Get commentId
     *
     * @return integer 
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Comment
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return Comment
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Comment
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set userUser
     *
     * @param \Homepage\BlogBundle\Entity\User $userUser
     * @return Comment
     */
    public function setUserUser(\Homepage\BlogBundle\Entity\User $userUser = null)
    {
        $this->userUser = $userUser;
    
        return $this;
    }

    /**
     * Get userUser
     *
     * @return \Homepage\BlogBundle\Entity\User 
     */
    public function getUserUser()
    {
        return $this->userUser;
    }

    /**
     * Set postPost
     *
     * @param \Homepage\BlogBundle\Entity\Post $postPost
     * @return Comment
     */
    public function setPostPost(\Homepage\BlogBundle\Entity\Post $postPost = null)
    {
        $this->postPost = $postPost;
    
        return $this;
    }

    /**
     * Get postPost
     *
     * @return \Homepage\BlogBundle\Entity\Post 
     */
    public function getPostPost()
    {
        return $this->postPost;
    }
}
