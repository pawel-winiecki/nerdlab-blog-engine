<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 */
class Post
{
    /**
     * @var integer
     */
    private $idPost;

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
    private $postsCategoriesPostsCategory;


    /**
     * Get idPost
     *
     * @return integer 
     */
    public function getIdPost()
    {
        return $this->idPost;
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
     * Set postsCategoriesPostsCategory
     *
     * @param \Homepage\BlogBundle\Entity\PostsCategory $postsCategoriesPostsCategory
     * @return Post
     */
    public function setPostsCategoriesPostsCategory(\Homepage\BlogBundle\Entity\PostsCategory $postsCategoriesPostsCategory = null)
    {
        $this->postsCategoriesPostsCategory = $postsCategoriesPostsCategory;
    
        return $this;
    }

    /**
     * Get postsCategoriesPostsCategory
     *
     * @return \Homepage\BlogBundle\Entity\PostsCategories 
     */
    public function getPostsCategoriesPostsCategory()
    {
        return $this->postsCategoriesPostsCategory;
    }
}
