<?php


namespace AppBundle\Services\Organisation;


use AppBundle\Entity\Organisation;
use AppBundle\Services\Party\PartyManager;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class OrganisationManager
 * @DI\Service("app.organisation.manager")
 *
 * @package AppBundle\Services\Organisation
 * @author Tiko Banyini <admin@tkbean.co.za>
 */
class OrganisationManager
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var PartyManager
     */
    private $partyManager;

    /**
     *
     * @DI\InjectParams({
     * "logger" = @DI\Inject("logger"),
     * "em" = @DI\Inject("doctrine.orm.entity_manager"),
     * "partyManager" = @DI\Inject("app.party.manager")
     * })
     *
     * @param Logger $logger
     * @param EntityManager $em
     * @param PartyManager $partyManager
     */
    public function __construct(Logger $logger, EntityManager $em, PartyManager $partyManager){
        $this->logger = $logger;
        $this->em = $em;
        $this->partyManager = $partyManager;
    }

    /**
     * @param Organisation $organisation
     * @return Organisation
     */
    public function createOrganisation(Organisation $organisation){
        $this->logger->info("OrganisationManager createOrganisation()");
        $this->partyManager->create($organisation->getParty());
        $this->em->persist($organisation);
        $this->em->flush();
        return $organisation;
    }

    /**
     * @param Organisation $organisation
     * @return bool
     * @author Tiko Banyini <admin@tkbean.co.za>
     */
    public function updateOrganisation(Organisation $organisation){
        $this->logger("OrganisationManager updateOrganisation()");

        $this->em->persist($organisation);
        $this->em->flush();
        return true;
    }

    /**
     * @param array $options
     * @return mixed
     * @author Tiko Banyini <admin@tkbean.co.za>
     */
    public function getListAll(array $options){
        $this->logger->info("OrganisationManager getListAll");
        return $this->em->getRepository("AppBundle:Organisation")->getAllQueryList($options);

    }

}