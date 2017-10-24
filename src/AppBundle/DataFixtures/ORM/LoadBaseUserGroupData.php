<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\UserGroup;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadBaseUserGroupData
 *
 * -Create base data to be loaded before the application starts
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage DataFixtures/ORM
 * @version 0.0.1
 */
class LoadBaseUserGroupData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @return void
     */
    function load(ObjectManager $manager)
    {

        /**
         * SUPER ADMIN
         */
        $superAdmin = new UserGroup('Super administrator');
        $superAdmin->addRole($this->getReference('role-admin'));
        $superAdmin->addRole($this->getReference('role-switch'));
        $superAdmin->addRole($this->getReference('role-dashboard-view'));


        /**
         * User roles
         */
        $superAdmin->addRole($this->getReference('role-user-list'));
        $superAdmin->addRole($this->getReference('role-user-create'));
        $superAdmin->addRole($this->getReference('role-user-profile'));
        $superAdmin->addRole($this->getReference('role-user-edit'));
        $superAdmin->addRole($this->getReference('role-user-delete'));
        $superAdmin->addRole($this->getReference('role-user-suspend'));
        $superAdmin->addRole($this->getReference('role-user-activate'));


        /**
         * ADMINISTRATOR
         */
        /**
         * User roles
         */
        $admin = new UserGroup('Administrator');
        $admin->addRole($this->getReference('role-dashboard-view'));
        $admin->addRole($this->getReference('role-user-list'));
        $admin->addRole($this->getReference('role-user-create'));
        $admin->addRole($this->getReference('role-user-profile'));
        $admin->addRole($this->getReference('role-user-edit'));
        $admin->addRole($this->getReference('role-user-suspend'));
        $admin->addRole($this->getReference('role-user-activate'));


        $manager->persist($superAdmin);
        $manager->persist($admin);
//
//
        $manager->flush();

        $this->addReference('group-super-admin', $superAdmin);
        $this->addReference('group-admin', $admin);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 20;
    }


}