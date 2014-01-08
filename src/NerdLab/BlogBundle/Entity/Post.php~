<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $postId;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $shortContent;

    /**
     * @var string
     */
    private $longContent;

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
     * @var \Homepage\BlogBundle\Entity\PostsCategory
     */
    private $postsCategoryPostsCategory;

    /**
     * @var \Homepage\BlogBundle\Entity\User
     */
    private $userUser;


    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Post
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortContent
     *
     * @param string $shortContent
     * @return Post
     */
    public function setShortContent($shortContent)
    {
        $this->shortContent = $shortContent;
    
        return $this;
    }

    /**
     * Get shortContent
     *
     * @return string 
     */
    public function getShortContent()
    {
        return $this->shortContent;
    }

    /**
     * Set longContent
     *
     * @param string $longContent
     * @return Post
     */
    public function setLongContent($longContent)
    {
        $this->longContent = $longContent;
    
        return $this;
    }

    /**
     * Get longContent
     *
     * @return string 
     */
    public function getLongContent()
    {
        return $this->longContent;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Set postsCategoryPostsCategory
     *
     * @param \Homepage\BlogBundle\Entity\PostsCategory $postsCategoryPostsCategory
     * @return Post
     */
    public function setPostsCategoryPostsCategory(\Homepage\BlogBundle\Entity\PostsCategory $postsCategoryPostsCategory = null)
    {
        $this->postsCategoryPostsCategory = $postsCategoryPostsCategory;
    
        return $this;
    }

    /**
     * Get postsCategoryPostsCategory
     *
     * @return \Homepage\BlogBundle\Entity\PostsCategory 
     */
    public function getPostsCategoryPostsCategory()
    {
        return $this->postsCategoryPostsCategory;
    }

    /**
     * Set userUser
     *
     * @param \Homepage\BlogBundle\Entity\User $userUser
     * @return Post
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
}
