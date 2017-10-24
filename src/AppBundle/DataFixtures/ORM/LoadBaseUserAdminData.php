<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Address;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Party;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

/**
 * LoadBaseUserAdminData
 *
 * -Create base data to be loaded before the application starts
 *
 * @author  Tiko Banyini <admin@tkbean.co.za>
 * @package AppBundle
 * @subpackage DataFixtures/ORM
 * @version 0.0.1
 */
class LoadBaseUserAdminData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @return void
     */
    function load(ObjectManager $manager)
    {
        $userService = $this->container->get("user.manager");
        $partyManager = $this->container->get('app.party.manager');

        $tikoParty = new Party();
        $tikoParty->setTitle($this->getReference("title-mr"));
        $tikoParty->setGender($this->getReference("gender-male"));
        $tikoParty->setFirstName("Tiko");
        $tikoParty->setLastName("Banyini");

        $tikoContact = new Contact();
        $tikoContact->setPrivateEmail("admin@tkbean.co.za");

        $tikoParty->setPostalAddress(new Address());
        $tikoParty->setPhysicalAddress(new Address());
        $tikoParty->setContact($tikoContact);
        $partyManager->create($tikoParty);

        $tiko = new User();
        $tiko->setParty($tikoParty);
        $tiko->setUsername('admin@tkbean.co.za');
        $tiko->setPassword("654321");

        $tiko->setStatus($this->getReference("status-active"));
        $tiko->setGroup($this->getReference("group-super-admin"));
        $tiko->setOrganisation($this->getReference('organisation-internal-tkbean'));
        $userService->create($tiko);


//        $operator = new User();
//        $operator->setFirstName("Operator");
//        $operator->setLastName("User");
//        $operator->setEmail("tbanyini@gmail.com");
//        $operator->setPassword("654321");
//        $operator->setStatus($this->getReference("status-active"));
//        $operator->setTitle($this->getReference("title-mr"));
//        $operator->setGender($this->getReference("gender-male"));
//        $operator->setGroup($this->getReference("group-operator"));
//        $operator->setOrganisation($this->getReference('organisation-internal-tkbean'));
//        $userService->create($operator);

        $this->addReference('admin-tiko' , $tiko) ;

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 40;
    }


}
