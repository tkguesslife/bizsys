<?php


namespace AppBundle\Form\Type\Party;

use AppBundle\Entity\Address;
use AppBundle\Form\Type\Address\AddressCreateType;
use AppBundle\Form\Type\Contact\ContactCreateType;
use AppBundle\Form\Type\Contact\ContactShowType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PartyShowType
 * @DI\Service("app.form.type.party.create")
 * @DI\Tag("form.type", attributes={"alias" = "PartyCreateType"})
 *
 * @package AppBundle\Form\Type\Party
 * @author Tiko Banyini
 */
class PartyCreateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('partyType', 'entity', array(
                'class' => 'AppBundle\Entity\PartyType',
                'label' => 'Type',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
            ->add('title', 'entity', array(
                    'class' => 'AppBundle\Entity\Title',
                    'label' => 'Title',
                    'attr' => array(
                        'class' => 'form-control'
                    ),

                )
            )
            ->add('firstName', 'text', array(
                    'label' => 'Firstname',
                    'attr' => array(
                        'class' => 'form-control'
                    ),

                )
            )
            ->add('lastName', 'text', array(
                'label' => 'Last name',
                'attr' => array(
                    'class' => 'form-control'
                ),

            ))
            ->add('registeredName', 'text', array(
                'label' => 'Registered name',
                'attr' => array(
                    'class' => 'form-control'
                ),

            ))
        ->add('contact', new ContactCreateType())
        ->add('postalAddress', new AddressCreateType())
        ->add('physicalAddress', new AddressCreateType())
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Party'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'PartyCreateType';
    }

}