<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * Title
 *
 * @ORM\Table(name="TITLE")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TitleRepository")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class Title
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="string", length=30)
     * @ORM\Id
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="TITLE", type="string", length=30)
     */
    private $title;

    /**
     * Class Construct
     *
     * @param $title
     */
    public function __construct($title = null)
    {
        if(!is_null($title)){
            $this->id = strtoupper($title);
            $this->title = $title;
        }

    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     * @return Title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Title
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
