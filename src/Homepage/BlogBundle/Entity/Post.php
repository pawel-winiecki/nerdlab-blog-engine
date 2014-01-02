<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post {

    /**
     * @var integer
     */
    private $id;

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
    private $postsCategory;

    /**
     * @var \Homepage\BlogBundle\Entity\User
     */
    private $user;

    /**
     * @var \Homepage\BlogBundle\Entity\ImageFile
     */
    private $imageFile;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Post
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    public function generateLinkFromTitle() {
        //remowe whitspace atd begin and end of string
        $link = trim($this->title);

        //change big letters to small
        $link = strtolower($link);

        //replace spaces with ndash
        $link = str_replace(' ', '-', $link);

        //remove more than one ndash in line
        $link = preg_replace('/[\-]+/', '-', $link);

        //convert diactric letters to ASCII letters
        $link = iconv("utf-8", "ascii//TRANSLIT", $link);

        //remove special characters
        $link = preg_replace('/[^a-z0-9\-]/', '', $link);

        $this->link = $link;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set shortContent
     *
     * @param string $shortContent
     * @return Post
     */
    public function setShortContent($shortContent) {
        $this->shortContent = $shortContent;

        return $this;
    }

    /**
     * Get shortContent
     *
     * @return string 
     */
    public function getShortContent() {
        return $this->shortContent;
    }

    /**
     * Set longContent
     *
     * @param string $longContent
     * @return Post
     */
    public function setLongContent($longContent) {
        $this->longContent = $longContent;

        return $this;
    }

    /**
     * Get longContent
     *
     * @return string 
     */
    public function getLongContent() {
        return $this->longContent;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Post
     */
    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return Post
     */
    public function setUpdatedOn($updatedOn) {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn() {
        return $this->updatedOn;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Post
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set postsCategory
     *
     * @param \Homepage\BlogBundle\Entity\PostsCategory $postsCategory
     * @return Post
     */
    public function setPostsCategory(\Homepage\BlogBundle\Entity\PostsCategory $postsCategory = null) {
        $this->postsCategory = $postsCategory;

        return $this;
    }

    /**
     * Get postsCategory
     *
     * @return \Homepage\BlogBundle\Entity\PostsCategory 
     */
    public function getPostsCategory() {
        return $this->postsCategory;
    }

    /**
     * Set user
     *
     * @param \Homepage\BlogBundle\Entity\User $user
     * @return Post
     */
    public function setUser(\Homepage\BlogBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Homepage\BlogBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set imageFile
     *
     * @param \Homepage\BlogBundle\Entity\ImageFile $imageFile
     * @return Post
     */
    public function setImageFile(\Homepage\BlogBundle\Entity\ImageFile $imageFile = null) {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * Get imageFile
     *
     * @return \Homepage\BlogBundle\Entity\ImageFile 
     */
    public function getImageFile() {
        return $this->imageFile;
    }

}
