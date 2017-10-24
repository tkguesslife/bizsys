<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * LoadBaseRoleData
 *
 * -Create base data to be loaded before the application starts
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage DataFixtures/ORM
 * @version 0.0.1
 */
class LoadBaseRoleData extends AbstractFixture implements OrderedFixtureInterface
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
         * User Roles
         */
        $admin = new Role("Super admin role", "ROLE_ADMIN");
        $manager->persist($admin);


        $switchRole = new Role("Allow role switching", "ROLE_ALLOWED_TO_SWITCH");
        $manager->persist($switchRole);


        $dashboardView = new Role("Dashboard view", "ROLE_DASHBOARD_VIEW");
        $manager->persist($dashboardView);


        /**
         * Organisation related roles
         */
        $organisationList = new Role("Organisation list", "ROLE_ORGANISATION_LIST");
        $manager->persist($organisationList);


        $organisationCreate = new Role("Organisation create", "ROLE_ORGANISATION_CREATE");
        $manager->persist($organisationCreate);


        $organisationProfile = new Role("Organisation profile", "ROLE_ORGANISATION_PROFILE");
        $manager->persist($organisationProfile);


        $organisationEdit = new Role("Organisation edit", "ROLE_ORGANISATION_EDIT");
        $manager->persist($organisationEdit);


        $organisationDelete = new Role("Organisation delete", "ROLE_ORGANISATION_DELETE");
        $manager->persist($organisationDelete);

        $organisationSuspend = new Role("Organisation suspend", "ROLE_ORGANISATION_SUSPEND");
        $manager->persist($organisationSuspend);


        $organisationExport = new Role("Organisation export", "ROLE_ORGANISATION_EXPORT");
        $manager->persist($organisationExport);


        /**
         * User related roles
         */
        $userList = new Role("User list", "ROLE_USER_LIST");
        $manager->persist($userList);


        $userCreate = new Role("User create", "ROLE_USER_CREATE");
        $manager->persist($userCreate);


        $userProfile = new Role("User profile", "ROLE_USER_PROFILE");
        $manager->persist($userProfile);


        $userEdit = new Role("User edit", "ROLE_USER_EDIT");
        $manager->persist($userEdit);


        $userDelete = new Role("User delete", "ROLE_USER_DELETE");
        $manager->persist($userDelete);


        $userSuspend = new Role("User suspend", "ROLE_USER_SUSPEND");
        $manager->persist($userSuspend);


        $userActivate = new Role("User activate", "ROLE_USER_ACTIVATE");
        $manager->persist($userActivate);


        $userExport = new Role("User export", "ROLE_USER_EXPORT");
        $manager->persist($userExport);

        $manager->flush();

        $this->addReference('role-admin', $admin);
        $this->addReference('role-switch', $switchRole);
        $this->addReference('role-dashboard-view', $dashboardView);
        $this->addReference('role-organisation-list', $organisationList);
        $this->addReference('role-organisation-create', $organisationCreate);
        $this->addReference('role-organisation-profile', $organisationProfile);
        $this->addReference('role-organisation-edit', $organisationEdit);
        $this->addReference('role-organisation-delete', $organisationDelete);
        $this->addReference('role-organisation-suspend', $organisationSuspend);
        $this->addReference('role-organisation-export', $organisationExport);
        $this->addReference('role-user-list', $userList);
        $this->addReference('role-user-create', $userCreate);
        $this->addReference('role-user-profile', $userProfile);
        $this->addReference('role-user-edit', $userEdit);
        $this->addReference('role-user-delete', $userDelete);
        $this->addReference('role-user-suspend', $userSuspend);
        $this->addReference('role-user-activate', $userActivate);
        $this->addReference('role-user-export', $userExport);
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