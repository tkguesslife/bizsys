<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\Date;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Class PartyType
 * @ORM\Table(name="PARTY_TYPE")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PartyTypeRepository")
 * @ORM\HasLifecycleCallbacks()
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class PartyType
{

    CONST PERSON = 'PERSON';

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
     * @ORM\Column(name="PARTY_TYPE", type="string", length=50, nullable=true)
     * @Expose
     */
    private $partyType;

    public function __toString()
    {
        return $this->partyType;
    }


    /**
     * Set id
     *
     * @param string $id
     * @return PartyType
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
     * Set partyType
     *
     * @param string $partyType
     * @return PartyType
     */
    public function setPartyType($partyType)
    {
        $this->partyType = $partyType;

        return $this;
    }

    /**
     * Get partyType
     *
     * @return string 
     */
    public function getPartyType()
    {
        return $this->partyType;
    }
}
