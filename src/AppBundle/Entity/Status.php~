<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * Status
 *
 * @ORM\Table(name="STATUS")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\StatusRepository")
 * @ExclusionPolicy("all")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class Status
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
     * @var integer
     *
     * @ORM\Column(name="CODE", type="integer")
     */
    private $code;

    /**
     * Class Construct
     *
     * @param $name
     * @param $code
     */
    public function __construct($name,$code)
    {
        $this->name = $name;
        $this->code = $code;
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
     * @return Status
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
     * Set code
     *
     * @param integer $code
     * @return Status
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Status
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
