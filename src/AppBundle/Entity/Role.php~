<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * Role
 *
 * @ORM\Table(name="ROLE")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RoleRepository")
 * @ExclusionPolicy("all")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class Role implements RoleInterface
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
     * @ORM\Column(name="NAME", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="ROLE", type="string", length=50, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="userRoles")
     */
    private $users;

    /**
     * Class Construct
     *
     * @param $name
     * @param $role
     *
     */
    public function __construct($name,$role)
    {
        $this->name = $name;
        $this->role = $role;
    }

    public function __toString()
    {
        return $this->getRole();
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
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the role.
     *
     * This method returns a string representation whenever possible.
     *
     * When the role cannot be represented with sufficient precision by a
     * string, it should return null.
     *
     * @return string|null A string representation of the role, or null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    /**
     * Add users
     *
     * @param \AppBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\AppBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUser(\AppBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
