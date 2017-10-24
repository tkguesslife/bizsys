<?php

namespace AppBundle\Services\Core;

use AppBundle\Entity\Status;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * GenderManager
 *
 * @DI\Service("gender.manager")
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Services
 * @version 0.0.1
 *
 */
class GenderManager
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
     * Get gender by name
     *
     * @param String $genderName
     * @return AppBundle:Gender
     * @throws \Exception
     */
    public function getGenderByName($genderName)
    {
        $this->logger->info('gender.manager getGenderByName()');

        $gender = $this->em
            ->getRepository('AppBundle:Gender')
            ->getGender($genderName);

        if (!$gender) {
            $this->logger->error('gender.manager getGenderByName()' . $genderName . ' gender');
            throw new \Exception('Exception, no ' . $genderName . ' gender found');
        }

        return $gender;
    }



}
