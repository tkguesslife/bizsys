<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Class Invoice
 * @ORM\Table(name="INVOICE")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InvoiceRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable
 * @ExclusionPolicy("all")
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class Invoice
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
     * @var Client
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Client")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="CLIENT_ID", referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     * @Expose
     */
    private $client;


    /**
     * @var Frequency
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Frequency")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="FREQUENCY_ID", referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    private $frequency;

    /**
     * @var Status
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STATUS_ID",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     */
    private $status;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\InvoiceItem", mappedBy="invoice")
     */
    private $items;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED_AT", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UPDATE_AT", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updateAt;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CREATED_BY_ID",referencedColumnName="ID")
     * })
     */
    private $createdBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UPDATED_BY_ID",referencedColumnName="ID")
     * })
     */
    private $updatedBy;


    /**
     * Set id
     *
     * @param string $id
     *
     * @return Invoice
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Invoice
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Invoice
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Invoice
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Invoice
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \AppBundle\Entity\User $updatedBy
     *
     * @return Invoice
     */
    public function setUpdatedBy(\AppBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set frequency
     *
     * @param \AppBundle\Entity\Frequency $frequency
     *
     * @return Invoice
     */
    public function setFrequency(\AppBundle\Entity\Frequency $frequency = null)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return \AppBundle\Entity\Frequency
     */
    public function getFrequency()
    {
        return $this->frequency;
    }
}
