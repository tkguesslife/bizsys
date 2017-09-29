<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Class Party
 * @ORM\Table(name="PARTY")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PartyRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class Party
{

    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;


    /**
     * @var string
     *  @ORM\ManyToOne(targetEntity="AppBundle\Entity\PartyType")
     *  @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PARTY_TYPE",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    private $partyType;


    /**
     *  @var string
     *  @ORM\ManyToOne(targetEntity="AppBundle\Entity\Title")
     *  @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TITLE",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="FIRSTNAME", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="SURNAME", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @var string
     * @ORM\Column(name="REGISTERED_NAME", type="string", length=255, nullable=true)
     */
    private $registeredName;

    /**
     * @var string
     * @ORM\Column(name="ID_NUMBER", type="string", length=50, nullable=true)
     */
    private $idNumber;

    /**
     * @var string
     * @ORM\Column(name="REGISTRATION_NO", type="string", length=255, nullable=true)
     */
    private $registrationNo;

    /**
     * @var string
     * @ORM\Column(name="PASSPORT_NUMBER", type="string", length=50, nullable=true)
     */
    private $passportNumber;

    /**
     * @var string
     * @ORM\Column(name="PASSPORT_COUNTRY_OF_ISSUE", type="string", length=50, nullable=true)
     */
    private $passportCountryOfIssue;

    /**
     * @var Date
     * @ORM\Column(name="DATE_OF_BIRTH", type="datetime", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var string
     * @ORM\Column(name="MARITAL_STATUS", type="string", length=50, nullable=true)
     */
    private $maritalStatus;

    /**
     * @var string
     * @ORM\Column(name="GENDER", type="string", length=50, nullable=true)
     */
    private $gender;

    /**
     * @var string
     * @ORM\Column(name="HAS_GUARDIAN", type="boolean", nullable=true)
     */
    private $hasGuardian = false;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address", inversedBy="partyPostalAddress", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="POSTAL_ADDRESS_ID", referencedColumnName="ID")
     */
    private $postalAddress;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address", inversedBy="partyPhysicalAddress", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="PHYSICAL_ADDRESS_ID", referencedColumnName="ID")
     */
    private $physicalAddress;


    /**
     * @var string
     * @ORM\Column(name="SALUTATION", type="string", length=100, nullable=true)
     */
    private $salutation;

    /**
     * @var string
     * @ORM\Column(name="SECOND_NAME", type="string", length=100, nullable=true)
     */
    private $secondName;

    /**
     * @var string
     * @ORM\Column(name="INITIAL", type="string", length=100, nullable=true)
     */
    private $initial;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="party", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="CONTACT_ID", referencedColumnName="ID")
     */
    private $contact;

    /**
     * @var string
     * @ORM\Column(name="TAX_NO", type="string", length=50, nullable=true)
     */
    private $taxNo;

    /**
     * @var string
     * @ORM\Column(name="TAX_OFFICE", type="string", length=50, nullable=true)
     */
    private $taxOffice;

    /**
     * @var string
     * @ORM\Column(name="EXTERNAL_SOURCE_NAME", type="string", length=50, nullable=true)
     */
    private $externalSourceName;

    /**
     * @var string
     * @ORM\Column(name="EXTERNAL_SOURCE_ID", type="string", length=50, nullable=true)
     */
    private $externalSourceId;


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

    public function __toString()
    {
        return $this->firstname+' '+$this->surname;
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
     * Set firstname
     *
     * @param string $firstname
     * @return Party
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Party
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Party
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
     * Set registeredName
     *
     * @param string $registeredName
     * @return Party
     */
    public function setRegisteredName($registeredName)
    {
        $this->registeredName = $registeredName;

        return $this;
    }

    /**
     * Get registeredName
     *
     * @return string 
     */
    public function getRegisteredName()
    {
        return $this->registeredName;
    }

    /**
     * Set idNumber
     *
     * @param string $idNumber
     * @return Party
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * Get idNumber
     *
     * @return string 
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * Set registrationNo
     *
     * @param string $registrationNo
     * @return Party
     */
    public function setRegistrationNo($registrationNo)
    {
        $this->registrationNo = $registrationNo;

        return $this;
    }

    /**
     * Get registrationNo
     *
     * @return string 
     */
    public function getRegistrationNo()
    {
        return $this->registrationNo;
    }

    /**
     * Set passportNumber
     *
     * @param string $passportNumber
     * @return Party
     */
    public function setPassportNumber($passportNumber)
    {
        $this->passportNumber = $passportNumber;

        return $this;
    }

    /**
     * Get passportNumber
     *
     * @return string 
     */
    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    /**
     * Set passportCountryOfIssue
     *
     * @param string $passportCountryOfIssue
     * @return Party
     */
    public function setPassportCountryOfIssue($passportCountryOfIssue)
    {
        $this->passportCountryOfIssue = $passportCountryOfIssue;

        return $this;
    }

    /**
     * Get passportCountryOfIssue
     *
     * @return string 
     */
    public function getPassportCountryOfIssue()
    {
        return $this->passportCountryOfIssue;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     * @return Party
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string 
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Party
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set hasGuardian
     *
     * @param string $hasGuardian
     * @return Party
     */
    public function setHasGuardian($hasGuardian)
    {
        $this->hasGuardian = $hasGuardian;

        return $this;
    }

    /**
     * Get hasGuardian
     *
     * @return string 
     */
    public function getHasGuardian()
    {
        return $this->hasGuardian;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Party
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
     * @return Party
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
     * Set postalAddress
     *
     * @param \AppBundle\Entity\Address $postalAddress
     * @return Party
     */
    public function setPostalAddress(\AppBundle\Entity\Address $postalAddress = null)
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get postalAddress
     *
     * @return \AppBundle\Entity\Address 
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * Set physicalAddress
     *
     * @param \AppBundle\Entity\Address $physicalAddress
     * @return Party
     */
    public function setPhysicalAddress(\AppBundle\Entity\Address $physicalAddress = null)
    {
        $this->physicalAddress = $physicalAddress;

        return $this;
    }

    /**
     * Get physicalAddress
     *
     * @return \AppBundle\Entity\Address 
     */
    public function getPhysicalAddress()
    {
        return $this->physicalAddress;
    }

    /**
     * Set externalSourceName
     *
     * @param string $externalSourceName
     * @return Party
     */
    public function setExternalSourceName($externalSourceName)
    {
        $this->externalSourceName = $externalSourceName;

        return $this;
    }

    /**
     * Get externalSourceName
     *
     * @return string 
     */
    public function getExternalSourceName()
    {
        return $this->externalSourceName;
    }

    /**
     * Set externalSourceId
     *
     * @param string $externalSourceId
     * @return Party
     */
    public function setExternalSourceId($externalSourceId)
    {
        $this->externalSourceId = $externalSourceId;

        return $this;
    }

    /**
     * Get externalSourceId
     *
     * @return string 
     */
    public function getExternalSourceId()
    {
        return $this->externalSourceId;
    }

    /**
     * Set salutation
     *
     * @param string $salutation
     * @return Party
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation
     *
     * @return string 
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Set taxNo
     *
     * @param string $taxNo
     * @return Party
     */
    public function setTaxNo($taxNo)
    {
        $this->taxNo = $taxNo;

        return $this;
    }

    /**
     * Get taxNo
     *
     * @return string 
     */
    public function getTaxNo()
    {
        return $this->taxNo;
    }

    /**
     * Set taxOffice
     *
     * @param string $taxOffice
     * @return Party
     */
    public function setTaxOffice($taxOffice)
    {
        $this->taxOffice = $taxOffice;

        return $this;
    }

    /**
     * Get taxOffice
     *
     * @return string 
     */
    public function getTaxOffice()
    {
        return $this->taxOffice;
    }

    /**
     * Set contact
     *
     * @param \AppBundle\Entity\Contact $contact
     * @return Party
     */
    public function setContact(\AppBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \AppBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     * @return Party
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string 
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set initial
     *
     * @param string $initial
     * @return Party
     */
    public function setInitial($initial)
    {
        $this->initial = $initial;

        return $this;
    }

    /**
     * Get initial
     *
     * @return string 
     */
    public function getInitial()
    {
        return $this->initial;
    }


    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Party
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set partyType
     *
     * @param \AppBundle\Entity\PartyType $partyType
     * @return Party
     */
    public function setPartyType(\AppBundle\Entity\PartyType $partyType = null)
    {
        $this->partyType = $partyType;

        return $this;
    }

    /**
     * Get partyType
     *
     * @return \AppBundle\Entity\PartyType 
     */
    public function getPartyType()
    {
        return $this->partyType;
    }
}
