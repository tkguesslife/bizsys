<?php


namespace AppBundle\Services\Client;

use AppBundle\Entity\Client;
use AppBundle\Services\Party\PartyManager;
use AppBundle\Services\User\UserManager;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use JMS\DiExtraBundle\Annotation as DI;


/**
 * Class ClientManager
 * @DI\Service("app.client.manager")
 * @package AppBundle\Services\Client
 * @author Tiko Banyini
 */
class ClientManager
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
     * @var UserManager
     */
    private $userManager;

    /**
     *
     * @DI\InjectParams({
     * "logger" = @DI\Inject("logger"),
     * "em" = @DI\Inject("doctrine.orm.entity_manager"),
     * "partyManager" = @DI\Inject("app.party.manager"),
     * "userManager" = @DI\Inject("user.manager")
     * })
     *
     * @param Logger $logger
     * @param EntityManager $em
     * @param PartyManager $partyManager
     * @param UserManager $userManager
     */
    public function __construct(Logger $logger, EntityManager $em, PartyManager $partyManager, UserManager $userManager){
        $this->logger = $logger;
        $this->em = $em;
        $this->partyManager = $partyManager;
        $this->userManager = $userManager;
    }


    /**
     * @param Client $client
     * @return Client
     */
    public function create(Client $client){
        $this->logger->info('ClientManager create()');
        if(!$client->getCreatedBy() && is_object($createdBy = $this->userManager->getCurrentUser())){
            $client->setCreatedBy($createdBy);
        }

        if(!$client->getOrganisation() && is_object($organisation = $this->userManager->getCurrentUserOrganisation())){
            $client->setOrganisation($organisation);
        }

        $this->em->persist($client);
        $this->em->flush();
        return $client;
    }


    /**
     * @param Client $client
     * @return Client
     */
    public function update(Client $client){
        $this->logger->info('ClientManager update()');
        if(!$client->getUpdatedBy() && is_object($updatedBy = $this->userManager->getCurrentUser())){
            $client->setUpdatedBy($updatedBy);
        }

        if(!$client->getOrganisation() && is_object($organisation = $this->userManager->getCurrentUserOrganisation())){
            $client->setOrganisation($organisation);
        }
        $this->em->persist($client);
        $this->em->flush();
        return $client;
    }

    /**
     * @param array $options
     * @return \Doctrine\ORM\Query
     */
    public function getListAll(array $options){
        $this->logger->info("ClientManager getListAll()");
        return $this->em->getRepository('AppBundle:Client')->getAllQueryList($options);
    }




}