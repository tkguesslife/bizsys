<?php

namespace AppBundle\Services\Core;

use AppBundle\Entity\Status;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * StatusManager
 *
 * @DI\Service("status.manager")
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Services
 * @version 0.0.1
 *
 */
class StatusManager
{
    /**
     * @var Monolog logger
     */
    protected $logger;

    /**
     * @var Entity manager
     */
    protected $em;

    /**
     * Class construct
     *
     * @param EntityManager   $em
     * @param Logger          $logger
     *
     *
     * @DI\InjectParams({
     *     "em"          = @DI\Inject("doctrine.orm.entity_manager"),
     *     "logger"      = @DI\Inject("logger"),
     * })
     */
    public function __construct(EntityManager $em,Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;

        return $this;
    }

    /**
     * Get status by name
     *
     * @param String $statusName
     * @return AppBundle:Status
     * @throws \Exception
     */
    public function getStatusByName($statusName)
    {
        $this->logger->info('Status.Manager getStatusByName()');

        $status = $this->em
            ->getRepository('AppBundle:Status')
            ->getStatus($statusName);

        if (!$status) {
            $this->logger->error('Status.Manager getStatusByName()' . $statusName . ' status');
            throw new \Exception('Exception, no ' . $statusName . ' status found');
        }

        return $status;
    }

    /**
     * get active status
     * @return AppBundle:Status
     */
    public function active()
    {
        $this->logger->info('Status.Manager active()');
        return $this->getStatusByName('Active');
    }

    /**
     * get lock status
     * @return AppBundle:Status
     */
    public function locked()
    {
        $this->logger->info('Status.Manager locked()');
        return $this->getStatusByName('Locked');
    }

    /**
     * get expired status
     * @return AppBundle:Status
     */
    public function expired()
    {
        $this->logger->info('Status.Manager expired()');
        return $this->getStatusByName('Expired');
    }

    /**
     * get delete status
     * @return AppBundle:Status
     */
    public function deleted()
    {
        $this->logger->info('Status.Manager deleted()');
        return $this->getStatusByName('Deleted');
    }

    /**
     * get approved status
     * @return AppBundle:Status
     */
    public function approved()
    {
        $this->logger->info('Status.Manager approve()');
        return $this->getStatusByName('Approved');
    }

    /**
     * get rejected status
     * @return AppBundle:Status
     */
    public function rejected()
    {
        $this->logger->info('Status.Manager reject()');
        return $this->getStatusByName('Rejected');
    }

    /**
     * get pending status
     * @return AppBundle:Status
     */
    public function pending()
    {
        $this->logger->info('Status.Manager pending()');
        return $this->getStatusByName('Pending');
    }

    /**
     * get suspended status
     * @return AppBundle:Status
     */
    public function suspended()
    {
        $this->logger->info('Status.Manager suspended()');
        return $this->getStatusByName('Suspended');
    }

    /**
     * get pending verification status
     * @return Status
     */
    public function pendingVerification(){
        $this->logger->info('Status.Manager pendingVerification()');
        return $this->getStatusByName('Pending verification');
    }

    /**
     * get pending verification status
     * @return Status
     */
    public function verified(){
        $this->logger->info('Status.Manager verified()');
        return $this->getStatusByName('Verified');
    }

    /**
     * get submitted status
     * @return Status
     */
    public function submitted(){
        $this->logger->info('Status.Manager submitted()');
        return $this->getStatusByName('Submitted');
    }

    /**
     * get excluded status
     * @return Status
     */
    public function excluded(){
        $this->logger->info('Status.Manager excluded()');
        return $this->getStatusByName('Excluded');
    }

    /**
     * get requested revocation status
     * @return Status
     */
    public function requestedRevocation(){
        $this->logger->info('Status.Manager requestedRevocation()');
        return $this->getStatusByName('Requested revocation');
    }

}
