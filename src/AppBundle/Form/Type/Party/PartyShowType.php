<?php


namespace AppBundle\Form\Type\Party;

use AppBundle\Form\Type\Contact\ContactShowType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PartyShowType
 * @DI\Service("app.form.type.party.show")
 * @DI\Tag("form.type", attributes={"alias" = "PartyShowType"})
 *
 * @package AppBundle\Form\Type\Party
 * @author Tiko Banyini
 */
class PartyShowType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'entity', array(
                    'class' => 'AppBundle\Entity\Title',
                    'label' => 'Title',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'disabled' => true
                )
            )
            ->add('firstName', 'text', array(
                    'label' => 'Firstname',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'disabled' => true
                )
            )
            ->add('lastName', 'text', array(
                'label' => 'Last name',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'disabled' => true
            ))
            ->add('registeredName', 'text', array(
                'label' => 'Registered name',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'disabled' => true
            ))
        ->add('contact', new ContactShowType())
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
        return 'PartyShowType';
    }

}