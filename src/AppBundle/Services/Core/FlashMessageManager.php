<?php


namespace AppBundle\Services\Core;

use JMS\DiExtraBundle\Annotation as DI;
use JMS\DiExtraBundle\Annotation\Inject;

/**
 * Class FlashMessageManager
 *
 * @DI\Service("flash.message.manager")
 *
 * @package AppBundle\Services\Core
 * @author Tiko Banyini <admin@tkbean.co.za>
 */
class FlashMessageManager
{
    /**
     * Monolog logger.
     *
     * @var Service
     * @Inject("logger")
     */
    public $logger;

    /**
     * Session.
     *
     * @var object
     * @Inject("session")
     */
    public $session;

    /**
     * Get error message.
     *
     * @param String $msg
     */
    public function getErrorMessage($msg = null)
    {
        $this->logger->info('FlashMessageManager getErrorMessage()');
        $this->session->getFlashBag()->add(
            'error',
            $msg ? $msg : 'Some information is invalid, Please see the details below!'
        );

        return;
    }

    /**
     * Get success message.
     *
     * @param String $msg
     */
    public function getSuccessMessage($msg)
    {
        $this->logger->info('FlashMessageManager getSuccessMessage()');
        $this->session->getFlashBag()->add(
            'success',
            $msg
        );

        return;
    }

    /**
     * Get warning message.
     *
     * @param String $msg
     */
    public function getWarningMessage($msg)
    {
        $this->logger->info('FlashMessageManager getWarningMessage()');
        $this->session->getFlashBag()->add(
            'warning',
            $msg
        );

        return;
    }

    /**
     * Get info message.
     *
     * @param String $msg
     */
    public function getInfoMessage($msg)
    {
        $this->logger->info('FlashMessageManager getInfoMessage()');
        $this->session->getFlashBag()->add(
            'info',
            $msg
        );

        return;
    }
}