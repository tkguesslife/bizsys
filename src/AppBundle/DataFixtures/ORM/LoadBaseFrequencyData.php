<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Frequency;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * LoadBaseFrequencyData
 *
 * -Create base data to be loaded before the application starts
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage DataFixtures/ORM
 * @version 0.0.1
 */
class LoadBaseFrequencyData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @return void
     */
    function load(ObjectManager $manager)
    {
        $daily = new Frequency("Daily");
        $manager->persist($daily);

        $weekly = new Frequency("Weekly");
        $manager->persist($weekly);

        $monthly = new Frequency("Monthly");
        $manager->persist($monthly);

        $quarterly = new Frequency("Quarterly");
        $manager->persist($quarterly);

        $biAnnually = new Frequency("Bi-annually");
        $manager->persist($biAnnually);

        $annually = new Frequency("Annually");
        $manager->persist($annually);

        $manager->flush() ;

        $this->addReference('frequency-daily' , $daily) ;
        $this->addReference('frequency-weekly' , $weekly) ;
        $this->addReference('frequency-monthly' , $monthly) ;
        $this->addReference('frequency-quarterly' , $quarterly) ;
        $this->addReference('frequency-bi-annually' , $biAnnually) ;
        $this->addReference('frequency-annually' , $annually) ;

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }


}