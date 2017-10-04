<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * UserGroup
 *
 * @ORM\Table(name="USER_GROUP")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserGroupRepository")
 *
 * @ExclusionPolicy("all")
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class UserGroup
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="ID", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=50)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="USER_GROUP_ROLE_MAP",
     * joinColumns={@ORM\JoinColumn(name="USER_GROUP_ID", referencedColumnName="ID")},
     * inverseJoinColumns={@ORM\JoinColumn(name="ROLE_ID", referencedColumnName="ID")}
     * )
     */
    private $roles;

    /**
     * Class Construct
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
     * @return UserGroup
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
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     * @return UserGroup
     */
    public function addRole(\AppBundle\Entity\Role $role){
        $this->roles[] = $role;
        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     * @return UserGroup
     */
    public function removeRole(\AppBundle\Entity\Role $role){
        $this->roles->removeElement($role);
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

}
