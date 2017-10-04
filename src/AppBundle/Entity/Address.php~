<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Address
 * @ORM\Table(name="ADDRESS")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable
 *
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class Address
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
     * @ORM\Column(name="LINE1", type="text", nullable=true)
     */
    private $line1;

    /**
     * @var string
     * @ORM\Column(name="LINE2", type="text", nullable=true)
     */
    private $line2;

    /**
     * @var string
     * @ORM\Column(name="LINE3", type="text", nullable=true)
     */
    private $line3;

    /**
     * @var string
     * @ORM\Column(name="SUBURB", type="text", nullable=true)
     */
    private $suburb;

    /**
     * @var string
     * @ORM\Column(name="CITY", type="text", nullable=true)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="REGION", type="text", nullable=true)
     */
    private $region;


    /**
     * @var string
     * @ORM\Column(name="AREA_CODE", type="string", length=50, nullable=true)
     */
    private $areaCode;


    /**
     * @var string
     *
     * @ORM\Column(name="COUNTRY", type="text", nullable=true)
     */
    private $country;


    /**
     * @var Party
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Party", mappedBy="postalAddress")
     */
    protected $partyPostalAddress;

    /**
     * @var Party
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Party", mappedBy="physicalAddress")
     */
    protected $partyPhysicalAddress;


    /**
     * @var datetime
     *
     * @ORM\Column(name="CREATED_AT", type="datetime")
     * @Gedmo\Timestampable(on="create")
     * @link https://github.com/stof/StofDoctrineExtensionsBundle
     */
    protected $createdAt;


    /**
     * @var datetime
     * @ORM\Column(name="UPDATED_AT", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     * @link https://github.com/stof/StofDoctrineExtensionsBundle
     */
    protected $updatedAt;


    /**
     * Get id
     *
     * @return guid 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set line1
     *
     * @param string $line1
     * @return Address
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * Get line1
     *
     * @return string 
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Set line2
     *
     * @param string $line2
     * @return Address
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * Get line2
     *
     * @return string 
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Set line3
     *
     * @param string $line3
     * @return Address
     */
    public function setLine3($line3)
    {
        $this->line3 = $line3;

        return $this;
    }

    /**
     * Get line3
     *
     * @return string 
     */
    public function getLine3()
    {
        return $this->line3;
    }

    /**
     * Set suburb
     *
     * @param string $suburb
     * @return Address
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return string 
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Address
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set areaCode
     *
     * @param string $areaCode
     * @return Address
     */
    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string 
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Address
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Address
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
     * Set partyPostalAddress
     *
     * @param \AppBundle\Entity\Party $partyPostalAddress
     * @return Address
     */
    public function setPartyPostalAddress(\AppBundle\Entity\Party $partyPostalAddress = null)
    {
        $this->partyPostalAddress = $partyPostalAddress;

        return $this;
    }

    /**
     * Get partyPostalAddress
     *
     * @return \AppBundle\Entity\Party 
     */
    public function getPartyPostalAddress()
    {
        return $this->partyPostalAddress;
    }

    /**
     * Set partyPhysicalAddress
     *
     * @param \AppBundle\Entity\Party $partyPhysicalAddress
     * @return Address
     */
    public function setPartyPhysicalAddress(\AppBundle\Entity\Party $partyPhysicalAddress = null)
    {
        $this->partyPhysicalAddress = $partyPhysicalAddress;

        return $this;
    }

    /**
     * Get partyPhysicalAddress
     *
     * @return \AppBundle\Entity\Party 
     */
    public function getPartyPhysicalAddress()
    {
        return $this->partyPhysicalAddress;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
