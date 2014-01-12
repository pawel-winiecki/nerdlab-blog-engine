<?php

namespace NerdLab\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsCategory represents posts category. Every post is in one category.
 */
class PostsCategory
{
    /**
     * @var integer | id of database entry.
     */
    private $id;

    /**
     * @var string | Name of category.
     */
    private $categoryName;

    /**
     * @var string | slug of category.
     */
    private $link;

    /**
     * @var string | description of category. Use in meta-description.
     */
    private $description;

    /**
     * @var \DateTime | Date of category create. Persist in DB.
     */
    private $createdOn;

    /**
     * @var \DateTime | Date of category update. Persist in DB.
     */
    private $updatedOn;

    /**
     * @var boolean | True if category is active. Persist in DB.
     */
    private $isActive;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     * @return PostsCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    
        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return PostsCategory
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
     * Set description
     *
     * @param string $description
     * @return PostsCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return PostsCategory
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
     * @return PostsCategory
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
     * @return PostsCategory
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
     * Required by admin bundle
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->categoryName;
    }
}