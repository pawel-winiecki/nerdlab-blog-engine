<?php

namespace NerdLab\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role
 */
class Role implements RoleInterface
{
    /**
     * @var integer | id of database entry.
     */
    private $id;

    /**
     * @var string | Role name. Symfony2 require 'ROLE_' at begining. Persist in DB.
     */
    private $roleName;

    /**
     * @var \DateTime | Date of role create. Persist in DB.
     */
    private $createdOn;

    /**
     * @var \DateTime | Date of role update. Persist in DB.
     */
    private $updatedOn;

    /**
     * @var boolean | True if role is active. Persist in DB.
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection | Collection of with this role. Persist in DB.
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set roleName
     *
     * @param string $roleName
     * @return Role
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    
        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * Add user
     *
     * @param \NerdLab\BlogBundle\Entity\User $user
     * @return Role
     */
    public function addUser(\NerdLab\BlogBundle\Entity\User $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \NerdLab\BlogBundle\Entity\User $user
     */
    public function removeUser(\NerdLab\BlogBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @see RoleInterface
     */
    public function getRole() {
        return $this->roleName;
    }
    
    /**
     * Required by admin bundle
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->roleName;
    }

}