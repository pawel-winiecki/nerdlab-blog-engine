<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsCategories
 */
class PostsCategory
{
    /**
     * @var integer
     */
    private $idPostsCategory;

    /**
     * @var string
     */
    private $categoryName;

    /**
     * @var string
     */
    private $description;

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
     * Get idPostsCategory
     *
     * @return integer 
     */
    public function getIdPostsCategory()
    {
        return $this->idPostsCategory;
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
