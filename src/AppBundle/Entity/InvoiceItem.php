<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Class InvoiceItem
 * @ORM\Table(name="INVOICE_ITEM")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InvoiceItemRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable
 * @ExclusionPolicy("all")
 * @package AppBundle\Entity
 * @author Tiko Banyini
 */
class InvoiceItem
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Invoice", inversedBy="items")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="INVOICE_ID", referencedColumnName="ID")
     * })
     * @Gedmo\Versioned
     * @Expose
     */
    private $invoice;

    /**
     * @var integer
     * @ORM\Column(name="QUANTITY", type="integer")
     * @Gedmo\Versioned
     */
    private $quantity;

    /**
     * @var string
     * @ORM\Column(name="ITEM_DESCRIPTION", type="text", nullable=false)
     * @Gedmo\Versioned
     * @Expose
     */
    private $description;

    /**
     * @var float
     * @ORM\Column(name="UNIT_PRICE", type="float")
     * @Gedmo\Versioned
     * @Expose
     */
    private $unitPrice;


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

}