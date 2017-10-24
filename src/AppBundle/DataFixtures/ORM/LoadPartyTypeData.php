<?php


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\PartyType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadPartyTypeData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
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
     * Load data fixtures with the passed EntityManager.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $personPartyType = new PartyType();
        $personPartyType->setId("PERSON");
        $personPartyType->setPartyType("Person");
        $manager->persist($personPartyType);


        $organisationPartyType = new PartyType();
        $organisationPartyType->setId("ORGANISATION");
        $organisationPartyType->setPartyType("Organisation");
        $manager->persist($organisationPartyType);

        $trustPartyType = new PartyType();
        $trustPartyType->setId("TRUST");
        $trustPartyType->setPartyType("Trust");
        $manager->persist($trustPartyType);
        $manager->flush();

        $this->addReference('party-type-person', $personPartyType);
        $this->addReference('party-type-organisation', $organisationPartyType);
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }

}