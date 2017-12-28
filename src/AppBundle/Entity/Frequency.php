<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Class Frequency
 * @ORM\Table(name="FREQUENCY")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FrequencyRepository")
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class Frequency
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
     * Set id
     *
     * @param string $id
     *
     * @return Frequency
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Frequency
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
}
