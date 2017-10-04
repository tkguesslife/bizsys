<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * AppBundle\Entity\User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 *
 * @ORM\Table(name="USER",
 *      indexes={@ORM\Index(name="search_context", columns={"username"})}
 * )
 *
 * @UniqueEntity(fields={"username"}, groups={"create","edit" ,"save_rest", "member_create"}, message="Email address is already being used by another user, please try another one."))
 * @ORM\HasLifecycleCallbacks
 *
 * @Gedmo\Loggable
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 *
 * @ExclusionPolicy("all")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 *
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     */
    protected $fullName;

    /**
     * @Gedmo\Slug(fields={"username"})
     * @ORM\Column(name="SLUG" , length=150 , unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="USERNAME", type="string", length=255, nullable=false)
     * @Gedmo\Versioned
     */
    protected $username;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "Password cannot be blank!", groups={"save_rest"})
     * @Assert\Length(
     *      min = "6",
     *      max = "20",
     *      minMessage = "Password must have at least {{ limit }} characters",
     *      maxMessage = "Password has a limit of {{ limit }} characters",
     *      groups={"forgot_password", "save_rest"}
     * )
     *
     * @ORM\Column(name="PASSWORD", type="string", length=255, nullable=false)
     * @Gedmo\Versioned
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(name="FORGOT_PASSWORD", type="string", length=255 , nullable=true)
     * @Gedmo\Versioned
     */
    protected $forgotPassword;

    /**
     * @var salt
     *
     * @ORM\Column(name="SALT",type="string", length=255)
     */
    protected $salt;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="USER_ROLE_MAP",
     *     joinColumns={@ORM\JoinColumn(name="USER_ID", referencedColumnName="ID")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ROLE_ID", referencedColumnName="ID")},
     * )
     *
     */
    protected $userRoles;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STATUS_ID", referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    protected $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_DELETED", type="boolean")
     * @Gedmo\Versioned
     */
    protected $deleted = false;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="GROUP_ID", referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    protected $group;



    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Party")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PARTY_ID",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     * @Expose
     */
    private $party;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organisation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ORGANISATION_ID",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     * @Expose
     */
    private $organisation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_ACTIVE", type="boolean")
     * @Gedmo\Versioned
     */
    protected $active = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_EXPIRED", type="boolean")
     * @Gedmo\Versioned
     */
    protected $expired = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_LOCKED", type="boolean")
     * @Gedmo\Versioned
     */
    protected $locked = false;

    /**
     * @var datetime
     *
     * @ORM\Column(name="LAST_LOGIN", type="datetime" , nullable= true)
     */
    protected $lastLogin;

    /**
     * @var datetime
     *
     * @ORM\Column(name="EXPIRES_AT", type="datetime" , nullable= true)
     */
    protected $expiresAt;

    /**
     * @var string
     *
     * @ORM\Column(name="CONFIRMATION_TOKEN", type="string" , length=254 ,nullable= true)
     */
    protected $confirmationToken;

    /**
     *
     * @var String
     */
    protected $transient;

    /**
     * @var datetime
     *
     * @ORM\Column(name="PASSWORD_REQUESTED_AT", type="datetime" , nullable= true)
     */
    protected $passwordRequestedAt;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $createdBy;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $deletedBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $suspendedBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $activatedBy;

    /**
     * @var datetime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="CREATED_AT", type="datetime")
     * @link https://github.com/stof/StofDoctrineExtensionsBundle
     */
    protected $createdAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="DELETED_AT", type="datetime" , nullable=true)
     */
    protected $deletedAt;

    /**
     * @var datetime
     *
     * @ORM\Column(name="UPDATED_AT", type="datetime")
     * @Gedmo\Timestampable(on="update")
     * @link https://github.com/stof/StofDoctrineExtensionsBundle
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SUSPEND_AT", type="datetime", nullable=true)
     *
     */
    private $suspendAt;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ACTIVATED_AT", type="datetime", nullable=true)
     *
     */
    private $activatedAt;

    /**
     * Class construct
     *
     */
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
    }


    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return $this->getUserRoles()->toArray();
    }


    /**
     * Compares this user to another to determine if they are the same.
     *
     * @param AdvancedUserInterface $user
     * @return bool
     */
    public function isEqualTo(AdvancedUserInterface $user)
    {
        return $this->username === $user->getUsername();
    }

    /**
     * @ORM\PrePersist()
     */
    public function finalizeUser()
    {
        if (null === $this->getUsername()) {
            $this->setUsername($this->getEmail());
        }

        if (null === $this->getExpiresAt()) {
            $date = new \DateTime();
            $this->setExpiresAt($date->modify('+6 months'));
        }
    }

    /**
     * @ORM\PreUpdate()
     */
    public function emailUsernameSync(){
        if ($this->getEmail() != $this->getUsername()) {
            $this->setUsername($this->getEmail());
        }
    }

    /**
     * @ORM\PrePersist()
     */
    public function encodePassword()
    {
        //set password encoding
        $this->setSalt(md5(time()));
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword($this->getPassword(), $this->getSalt());
        $this->setPassword($password);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->username,
            $this->password,
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool    true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return $this->expired?false:true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool    true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return $this->locked?false:true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool    true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return $this->locked?false:true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool    true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->active;
    }

    /**
     * Set transient
     *
     * @param string $transient
     * @return User
     */
    public function setTransient($transient)
    {
        $this->transient = $transient;

        return $this;
    }

    /**
     * Get transient
     *
     * @return string
     */
    public function getTransient()
    {
        return $this->transient;
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
     * Concat first and last name
     *
     * @return string
     */
    public function getFullName()
    {
        $this->fullName = ucfirst($this->getFirstName()).' '.ucfirst($this->getLastName());
        return $this->fullName;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }



    /**
     * Set slug
     *
     * @param string $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return User
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set expired
     *
     * @param boolean $expired
     * @return User
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return boolean
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     * @return User
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return User
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set passwordRequestedAt
     *
     * @param \DateTime $passwordRequestedAt
     * @return User
     */
    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    /**
     * Get passwordRequestedAt
     *
     * @return \DateTime
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return User
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add userRoles
     *
     * @param \AppBundle\Entity\Role $userRoles
     * @return User
     */
    public function addUserRole(\AppBundle\Entity\Role $userRoles)
    {
        $this->userRoles[] = $userRoles;

        return $this;
    }

    /**
     * Remove userRoles
     *
     * @param \AppBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\AppBundle\Entity\Role $userRoles)
    {
        $this->userRoles->removeElement($userRoles);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     * @return User
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set group
     *
     * @param \AppBundle\Entity\UserGroup $group
     * @return User
     */
    public function setGroup(\AppBundle\Entity\UserGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\UserGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set title
     *
     * @param \AppBundle\Entity\Title $title
     * @return User
     */
    public function setTitle(\AppBundle\Entity\Title $title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return \AppBundle\Entity\Title
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set organisation
     *
     * @param \AppBundle\Entity\Organisation $organisation
     * @return User
     */
    public function setOrganisation(\AppBundle\Entity\Organisation $organisation = null)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return \AppBundle\Entity\Organisation
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     * @return User
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set deletedBy
     *
     * @param \AppBundle\Entity\User $deletedBy
     * @return User
     */
    public function setDeletedBy(\AppBundle\Entity\User $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Set suspendAt
     *
     * @param \DateTime $suspendAt
     * @return User
     */
    public function setSuspendAt($suspendAt)
    {
        $this->suspendAt = $suspendAt;

        return $this;
    }

    /**
     * Get suspendAt
     *
     * @return \DateTime
     */
    public function getSuspendAt()
    {
        return $this->suspendAt;
    }

    /**
     * Set activatedAt
     *
     * @param \DateTime $activatedAt
     * @return User
     */
    public function setActivatedAt($activatedAt)
    {
        $this->activatedAt = $activatedAt;

        return $this;
    }

    /**
     * Get activatedAt
     *
     * @return \DateTime
     */
    public function getActivatedAt()
    {
        return $this->activatedAt;
    }

    /**
     * Set suspendedBy
     *
     * @param \AppBundle\Entity\User $suspendedBy
     * @return User
     */
    public function setSuspendedBy(\AppBundle\Entity\User $suspendedBy = null)
    {
        $this->suspendedBy = $suspendedBy;

        return $this;
    }

    /**
     * Get suspendedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getSuspendedBy()
    {
        return $this->suspendedBy;
    }

    /**
     * Set activatedBy
     *
     * @param \AppBundle\Entity\User $activatedBy
     * @return User
     */
    public function setActivatedBy(\AppBundle\Entity\User $activatedBy = null)
    {
        $this->activatedBy = $activatedBy;

        return $this;
    }

    /**
     * Get activatedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getActivatedBy()
    {
        return $this->activatedBy;
    }

    /**
     * Set forgotPassword
     *
     * @param string $forgotPassword
     * @return User
     */
    public function setForgotPassword($forgotPassword)
    {
        $this->forgotPassword = $forgotPassword;

        return $this;
    }

    /**
     * Get forgotPassword
     *
     * @return string
     */
    public function getForgotPassword()
    {
        return $this->forgotPassword;
    }


    /**
     * Set party
     *
     * @param \AppBundle\Entity\Party $party
     *
     * @return User
     */
    public function setParty(\AppBundle\Entity\Party $party = null)
    {
        $this->party = $party;

        return $this;
    }

    /**
     * Get party
     *
     * @return \AppBundle\Entity\Party
     */
    public function getParty()
    {
        return $this->party;
    }
}
