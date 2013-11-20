<?php

namespace Homepage\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

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
    private $roleRole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roleRole = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return User
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
     * @return User
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
     * @return User
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
     * Add roleRole
     *
     * @param \Homepage\BlogBundle\Entity\Role $roleRole
     * @return User
     */
    public function addRoleRole(\Homepage\BlogBundle\Entity\Role $roleRole)
    {
        $this->roleRole[] = $roleRole;
    
        return $this;
    }

    /**
     * Remove roleRole
     *
     * @param \Homepage\BlogBundle\Entity\Role $roleRole
     */
    public function removeRoleRole(\Homepage\BlogBundle\Entity\Role $roleRole)
    {
        $this->roleRole->removeElement($roleRole);
    }

    /**
     * Get roleRole
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoleRole()
    {
        return $this->roleRole;
    }
    
    /**
     * Required by admin bundle
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->login;
    }
}
