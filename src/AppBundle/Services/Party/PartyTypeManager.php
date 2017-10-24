<?php


namespace AppBundle\Service\Party;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Monolog\Logger;

/**
 * Class PartyTypeManager
 * @DI\Service("app.party_type.manager")
 * @package AppBundle\Service\Party
 * @author Tiko Banyini
 */
class PartyTypeManager
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * PartyManager constructor.
     * @DI\InjectParams({
     *     "logger" = @DI\Inject("logger"),
     *     "entityManager" = @DI\Inject("doctrine.orm.entity_manager")
     *
     *     })
     *
     * @param Logger $logger
     * @param EntityManager $entityManager
     */
    public function __construct(Logger $logger, EntityManager $entityManager)
    {
        $this->logger = $logger;
        $this->entityManager = $entityManager;
    }

    /**
     * get Organisation PartyType Object
     * @return \AppBundle\Entity\PartyType|null|object
     */
    public function getOrganisation(){
        return $this->entityManager->getRepository("AppBundle:PartyType")->findOneBy(array("partyType" => "Organisation"));
    }

}