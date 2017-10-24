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
use AppBundle\Entity\Organisation;

class LoadBaseOrganisationData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
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
        $organisationService = $this->container->get('app.organisation.manager');

        $internal = new Organisation();
        $internalParty = new Party();
        $internalParty->setRegistrationNo('1997/000012/07');
        $internalParty->setRegisteredName('TKBEAN - internal');
        $internalParty->setFirstname("TK");
        $internalParty->setPartyType($this->getReference('party-type-organisation'));
        $internalParty->setContact(new Contact());
        $internalParty->setPhysicalAddress(new Address());
        $internalParty->setPostalAddress(new Address());

        $internal->setParty($internalParty);
        $internal = $organisationService->createOrganisation($internal);

        $this->addReference('organisation-internal-tkbean', $internal);
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 3;
    }


}