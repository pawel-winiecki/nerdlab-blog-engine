<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role
 */
class Role implements RoleInterface
{
    /**
     * @var integer
     */
    private $roleId;

    /**
     * @var string
     */
    private $roleName;

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var \DateTime
     */
    private $uptadedOn;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userUser = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
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
     * Set uptadedOn
     *
     * @param \DateTime $uptadedOn
     * @return Role
     */
    public function setUptadedOn($uptadedOn)
    {
        $this->uptadedOn = $uptadedOn;
    
        return $this;
    }

    /**
     * Get uptadedOn
     *
     * @return \DateTime 
     */
    public function getUptadedOn()
    {
        return $this->uptadedOn;
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
     * Add userUser
     *
     * @param \Homepage\BlogBundle\Entity\User $userUser
     * @return Role
     */
    public function addUserUser(\Homepage\BlogBundle\Entity\User $userUser)
    {
        $this->userUser[] = $userUser;
    
        return $this;
    }

    /**
     * Remove userUser
     *
     * @param \Homepage\BlogBundle\Entity\User $userUser
     */
    public function removeUserUser(\Homepage\BlogBundle\Entity\User $userUser)
    {
        $this->userUser->removeElement($userUser);
    }

    /**
     * Get userUser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserUser()
    {
        return $this->userUser;
    }

    /**
     * @see RoleInterface
     */
    public function getRole() {
        return $this->roleName;
    }

}
