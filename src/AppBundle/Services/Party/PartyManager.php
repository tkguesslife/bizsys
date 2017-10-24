<?php


namespace AppBundle\Services\Party;

use AppBundle\Entity\Party;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Monolog\Logger;

/**
 * Class PartyManager
 * @DI\Service("app.party.manager")
 * @package AppBundle\Service\Party
 * @author Tiko Banyini
 */
class PartyManager
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
     * @param Party $party
     * @return Party
     */
    public function create(Party $party){
        $this->logger->info("app.party.manager create()");
        $this->entityManager->persist($party);
        $this->entityManager->flush();
        return $party;
    }

    /**
     * @param $idNumber
     * @return mixed
     */
    public function getPartyByIDNumber($idNumber){
        $this->logger->info("app.party.manager getPartyByIDNumber()");
        return $this->entityManager->getRepository('AppBundle:Party')->getByIDNumber($idNumber);
    }

    /**
     * @param $registeredName
     * @return mixed
     */
    public function getPartyByRegisteredName($registeredName){
        $this->logger->info("app.party.manager getPartyByRegisteredName()");
        return $this->entityManager->getRepository('AppBundle:Party')->getByRegisteredName($registeredName);
    }


}