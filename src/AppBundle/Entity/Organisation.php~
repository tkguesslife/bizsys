<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Organisation
 *
 * @ORM\Table(name="ORGANISATION",indexes={@ORM\Index(name="search_context", columns={"ID"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OrganisationRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @UniqueEntity(fields={"name"}, groups={"create","edit"},message="Organisation name is already being used, please try another name.")
 * @Gedmo\Loggable
 * @ExclusionPolicy("all")
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Entity
 * @version 0.0.1
 */
class Organisation
{
    /**
     * @var string
     *
     * @ORM\Column(name="ID", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Party")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PARTY_ID",referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     * @Expose
     */
    private $party;



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
     * @var boolean
     *
     * @ORM\Column(name="IS_ACTIVE", type="boolean")
     * @Gedmo\Versioned
     */
    protected $active = true;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_SUSPENDED", type="boolean")
     * @Gedmo\Versioned
     */
    protected $suspended = false;


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
     * @var \DateTime
     *
     * @ORM\Column(name="SUSPEND_AT", type="datetime", nullable=true)
     *
     */
    private $suspendAt;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ACTIVATED_AT", type="datetime", nullable=true)
     *
     */
    private $activatedAt;

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
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="DELETED_BY_ID",referencedColumnName="ID")
     * })
     */
    private $deletedBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SUSPENDED_BY_ID",referencedColumnName="ID")
     * })
     */
    private $suspendedBy;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ACTIVATED_BY_ID",referencedColumnName="ID")
     * })
     */
    private $activatedBy;

    public function __toString()
    {
        if(is_object($this->party)){
            return $this->party->__toString();
        }
    }

    /**
     * Class construct
     */
    public function __construct()
    {

    }



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
     * Set active
     *
     * @param boolean $active
     *
     * @return Organisation
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set suspended
     *
     * @param boolean $suspended
     *
     * @return Organisation
     */
    public function setSuspended($suspended)
    {
        $this->suspended = $suspended;

        return $this;
    }

    /**
     * Get suspended
     *
     * @return boolean
     */
    public function getSuspended()
    {
        return $this->suspended;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Organisation
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
     * @return Organisation
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
     * Set suspendAt
     *
     * @param \DateTime $suspendAt
     *
     * @return Organisation
     */
    public function setSuspendAt($suspendAt)
    {
        $this->suspendAt = $suspendAt;

        return $this;
    }

    /**
     * Get suspendAt
     *
     * @return \DateTime
     */
    public function getSuspendAt()
    {
        return $this->suspendAt;
    }

    /**
     * Set activatedAt
     *
     * @param \DateTime $activatedAt
     *
     * @return Organisation
     */
    public function setActivatedAt($activatedAt)
    {
        $this->activatedAt = $activatedAt;

        return $this;
    }

    /**
     * Get activatedAt
     *
     * @return \DateTime
     */
    public function getActivatedAt()
    {
        return $this->activatedAt;
    }

    /**
     * Set party
     *
     * @param \AppBundle\Entity\Party $party
     *
     * @return Organisation
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

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     *
     * @return Organisation
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Organisation
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
     * @return Organisation
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
     * Set deletedBy
     *
     * @param \AppBundle\Entity\User $deletedBy
     *
     * @return Organisation
     */
    public function setDeletedBy(\AppBundle\Entity\User $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Set suspendedBy
     *
     * @param \AppBundle\Entity\User $suspendedBy
     *
     * @return Organisation
     */
    public function setSuspendedBy(\AppBundle\Entity\User $suspendedBy = null)
    {
        $this->suspendedBy = $suspendedBy;

        return $this;
    }

    /**
     * Get suspendedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getSuspendedBy()
    {
        return $this->suspendedBy;
    }

    /**
     * Set activatedBy
     *
     * @param \AppBundle\Entity\User $activatedBy
     *
     * @return Organisation
     */
    public function setActivatedBy(\AppBundle\Entity\User $activatedBy = null)
    {
        $this->activatedBy = $activatedBy;

        return $this;
    }

    /**
     * Get activatedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getActivatedBy()
    {
        return $this->activatedBy;
    }
}
