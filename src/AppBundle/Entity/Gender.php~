<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Gender
 *
 * @ORM\Table(name="GENDER")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\GenderRepository")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class Gender
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="string", length=50)
     * @ORM\Id
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=50)
     */
    private $name;

    /**
     * Class Construct
     *
     * @param $name
     */
    public function __construct($name)
    {
        if(!is_null($name)) {
            $this->name = $name;
            $this->id = strtoupper($name);
        }
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
     * @return Gender
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
     * Set id
     *
     * @param string $id
     *
     * @return Gender
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
