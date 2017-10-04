<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Contact
 * @ORM\Table(name="CONTACT")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable
 *
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class Contact
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
     * @ORM\Column(name="PRIVATE_EMAIL", type="string", length=100, nullable=true)
     */
    private $privateEmail;

    /**
     * @var string
     * @ORM\Column(name="WORK_EMAIL", type="string", length=100, nullable=true)
     */
    private $workEmail;


    /**
     * @var string
     * @ORM\Column(name="CELLPHONE", type="string", length=255, nullable=true)
     */
    private $cellphone;

    /**
     * @var string
     * @ORM\Column(name="WORK_PHONE", type="string", length=255, nullable=true)
     */
    private $workPhone;

    /**
     * @var string
     * @ORM\Column(name="HOME_PHONE", type="string", length=255, nullable=true)
     */
    private $homePhone;

    /**
     * @var Party
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Party", mappedBy="contact")
     */
    private $party;



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
     * Set privateEmail
     *
     * @param string $privateEmail
     * @return Contact
     */
    public function setPrivateEmail($privateEmail)
    {
        $this->privateEmail = $privateEmail;

        return $this;
    }

    /**
     * Get privateEmail
     *
     * @return string 
     */
    public function getPrivateEmail()
    {
        return $this->privateEmail;
    }

    /**
     * Set workEmail
     *
     * @param string $workEmail
     * @return Contact
     */
    public function setWorkEmail($workEmail)
    {
        $this->workEmail = $workEmail;

        return $this;
    }

    /**
     * Get workEmail
     *
     * @return string 
     */
    public function getWorkEmail()
    {
        return $this->workEmail;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     * @return Contact
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string 
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set workPhone
     *
     * @param string $workPhone
     * @return Contact
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    /**
     * Get workPhone
     *
     * @return string 
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * Set homePhone
     *
     * @param string $homePhone
     * @return Contact
     */
    public function setHomePhone($homePhone)
    {
        $this->homePhone = $homePhone;

        return $this;
    }

    /**
     * Get homePhone
     *
     * @return string 
     */
    public function getHomePhone()
    {
        return $this->homePhone;
    }

    /**
     * Set party
     *
     * @param \AppBundle\Entity\Party $party
     * @return Contact
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
