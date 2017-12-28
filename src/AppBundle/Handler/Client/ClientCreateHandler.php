<?php


namespace AppBundle\Handler\Client;

use AppBundle\Services\Client\ClientManager;
use AppBundle\Services\Core\FlashMessageManager;
use JMS\DiExtraBundle\Annotation as DI;
use Monolog\Logger;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ClientCreateHandler
 * @DI\Service("app.client_create.handler")
 * @package AppBundle\Handler\Client
 * @author Tiko Banyini
 */
class ClientCreateHandler
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
     * ClientCreateHandler constructor.
     * @DI\InjectParams({
     * "logger" = @DI\Inject("logger"),
     * "clientManager" = @DI\Inject("app.client.manager"),
     * "flashMessageManager" = @DI\Inject("flash.message.manager")
     * })
     * @param Logger $logger
     * @param ClientManager $clientManager
     * @param FlashMessageManager $flashMessageManager
     */
    public function __construct(Logger $logger, ClientManager $clientManager, FlashMessageManager $flashMessageManager)
    {
        $this->logger = $logger;
        $this->clientManager = $clientManager;
        $this->flashMassageManager = $flashMessageManager;
    }

    public function handle(FormInterface $form, Request $request){
        $this->logger->info("ClientCreateHandler handle()");
        if(!$request->isMethod('post')){
            return false;
        }

        $form->handleRequest($request);
        if(!$form->isValid()){
            $this->flashMassageManager->getErrorMessage();
            return false;
        }

        $this->clientManager->create($form->getData());
        $this->flashMassageManager->getSuccessMessage('Client added successfully!');
        return true;


    }


}