<?php


namespace AppBundle\Handler\Client;

use AppBundle\Services\Client\ClientManager;
use AppBundle\Services\Core\FlashMessageManager;
use AppBundle\Services\Utils\Constants;
use Knp\Component\Pager\Paginator;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class ClientListHandler
 * @DI\Service("app.client_list.handler")
 * @package AppBundle\Handler\Client
 * @author Tiko Banyini
 */
class ClientListHandler
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var ClientManager
     */
    private $clientManager;

    /**
     * @var FlashMessageManager
     */
    private $flashMassageManager;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * ClientEditHandler constructor.
     * @DI\InjectParams({
     * "logger" = @DI\Inject("logger"),
     * "clientManager" = @DI\Inject("app.client.manager"),
     * "flashMessageManager" = @DI\Inject("flash.message.manager"),
     * "paginator" = @DI\Inject("knp_paginator")
     * })
     * @param Logger $logger
     * @param ClientManager $clientManager
     * @param FlashMessageManager $flashMessageManager
     * @param $paginator
     */
    public function __construct(Logger $logger, ClientManager $clientManager, FlashMessageManager $flashMessageManager, Paginator $paginator)
    {
        $this->logger = $logger;
        $this->clientManager = $clientManager;
        $this->flashMassageManager = $flashMessageManager;
        $this->paginator = $paginator;
    }

    public function handle(Request $request, $page){
        $this->logger->info("ClientListHandler handle()");

        $search = $request->query->get('search');
        $sort = $request->query->get('sort', 'party.firstName');
        $direction = $request->query->get('direction', 'asc');
        $filterBy = $request->query->get('filterBy', 0);
        $show = $request->query->get('show', Constants::NUM_ITEMS);

        $options = array(
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
//            'filterBy' => $filterBy,
        );

        $pagination = $this->paginator->paginate(
            $this->clientManager->getListAll($options),
            $request->query->get('page', $page), $show);

        if ($pagination->getTotalItemCount() == 0) {
            $this->flashMassageManager->getWarningMessage('No results found.');
        }

        return array(
            'pagination' => $pagination,
            'direction' => $direction,
            'showOptions' => array(20, 10, 30, 40, 50),
            'show' => $show,
            'search' => $search
        );



    }
}