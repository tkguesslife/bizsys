<?php

namespace AppBundle\Services\Core;

use AppBundle\Entity\Status;
use Doctrine\ORM\EntityManager;
use Monolog\Logger;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * TitleManager
 *
 * @DI\Service("title.manager")
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage Services
 * @version 0.0.1
 *
 */
class TitleManager
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
     * Get title by name
     *
     * @param String $titleName
     * @return AppBundle:Title
     * @throws \Exception
     */
    public function getTitleByName($titleName)
    {
        $this->logger->info('title.manager getTitleByName()');

        $title = $this->em
            ->getRepository('AppBundle:Title')
            ->getTitle($titleName);

        if (!$title) {
            $this->logger->error('title.manager getTitleByName()' . $titleName . ' title');
            throw new \Exception('Exception, no ' . $titleName . ' title found');
        }

        return $title;
    }



}
