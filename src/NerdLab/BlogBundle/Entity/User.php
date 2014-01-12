<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User class 
 */
class User implements AdvancedUserInterface, \Serializable {

    /**
     * @var integer | id of database entry.
     */
    private $id;

    /**
     * @var string | user's login. Persist in DB.
     */
    private $login;

    /**
     * @var string | user's email. Persist in DB.
     */
    private $email;

    /**
     * @var string | password's hash. Persist in DB.
     */
    private $password;

    /**
     * @var string | password's salt. Persist in DB.
     */
    private $salt;

    /**
     * @var string | Plain password. Used for model validation. Not persist in DB.
     */
    protected $plainPassword;

    /**
     * @var string | User's first name. Persist in DB.
     */
    private $firstName;

    /**
     * @var string | User's last name. Persist in DB.
     */
    private $lastName;

    /**
     * @var string | Author's link to Google+ Profile. Persist in DB.
     */
    private $googlePlusLink;

    /**
     * @var \DateTime | User's joind time. Persist in DB.
     */
    private $createdOn;

    /**
     * @var \DateTime | Time of last user update. Persist in DB.
     */
    private $updatedOn;

    /**
     * @var \DateTime
     */
    private $passwordRequestedAt;

    /**
     * @var boolean | True if account is active. Persist in DB.
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection | Collection of user's roles. Persist in DB.
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct() {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login) {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string 
     */
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set googlePlusLink
     *
     * @param string $googlePlusLink
     * @return User
     */
    public function setGooglePlusLink($googlePlusLink) {
        $this->googlePlusLink = $googlePlusLink;

        return $this;
    }

    /**
     * Get googlePlusLink
     *
     * @return string 
     */
    public function getGooglePlusLink() {
        return $this->googlePlusLink;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return User
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
     * @return User
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
     * Set passwordRequestedAt
     *
     * @param \DateTime $passwordRequestedAt
     * @return User
     */
    public function setPasswordRequestedAt($passwordRequestedAt) {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    /**
     * Get passwordRequestedAt
     *
     * @return \DateTime 
     */
    public function getPasswordRequestedAt() {
        return $this->passwordRequestedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
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
     * Add role
     *
     * @param \NerdLab\BlogBundle\Entity\Role $role
     * @return User
     */
    public function addRole(\NerdLab\BlogBundle\Entity\Role $role) {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \NerdLab\BlogBundle\Entity\Role $role
     */
    public function removeRole(\NerdLab\BlogBundle\Entity\Role $role) {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Method from UserInterface. Not implemented.
     * @see Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
     */
    public function eraseCredentials() {
        
    }

    /**
     * Method from UserInterface.
     * 
     * @see Symfony\Component\Security\Core\User\UserInterface::getRoles()
     * @return array | User's roles
     */
    public function getRoles() {
        return $this->role->toArray();
    }

    /**
     * Get salt. Method from UserInterface.
     * 
     * @see Symfony\Component\Security\Core\User\UserInterface::getSalt() 
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Get username. Return user's login. Method from UserInterface.
     * 
     * @see Symfony\Component\Security\Core\User\UserInterface::getUsername() 
     * @return string
     */
    public function getUsername() {
        return $this->login;
    }

    /**
     * Get isAccountNonExpired. Method from UserInterface. Not implemented.
     * 
     * @see Symfony\Component\Security\Core\User\AdvancedUserInterface::isAccountNonExpired() 
     * @return boolean
     */
    public function isAccountNonExpired() {
        return true;
    }

    /**
     * Get isAccountNonLocked. Method from UserInterface. Not implemented.
     * 
     * @see Symfony\Component\Security\Core\User\AdvancedUserInterface::isAccountNonLocked() 
     * @return boolean
     */
    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    /**
     * Get isEnabled. Return isActive. Method from UserInterface.
     * 
     * @see Symfony\Component\Security\Core\User\AdvancedUserInterface::isAccountNonLocked() 
     * @return boolean
     */
    public function isEnabled() {
        return $this->isActive;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize() {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list (
                $this->id,
                ) = unserialize($serialized);
    }

    /**
     * Required by admin bundle
     * 
     * @return string
     */
    public function __toString() {
        return $this->login;
    }

    /**
     * Method generate user name to show from firs or/and last name. 
     * If they aren't set return login.
     * 
     * @return string
     */
    public function getNameToShow() {
        if ($this->firstName || $this->lastName) {
            return trim($this->firstName . ' ' . $this->lastName);
        }

        return $this->login;
    }

}
