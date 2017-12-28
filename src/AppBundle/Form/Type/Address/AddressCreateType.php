<?php


namespace AppBundle\Form\Type\Address;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class AddressCreateType
 * @DI\Service("app.form.type.address.create")
 * @DI\Tag("form.type", attributes={"alias" = "AddressCreateType"})
 * @package AppBundle\Form\Type\Address
 * @author Tiko Banyini
 */
class AddressCreateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('line1', 'text', array(
                'label' => 'Postal address 1',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('line2', 'text', array(
                'label' => 'Postal address 2',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('line3', 'text', array(
                'label' => 'Postal address 3',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('suburb', 'text', array(
                'label' => 'Suburb',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('city', 'text', array(
                'label' => 'City',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))
            ->add('areaCode', 'text', array(
                'label' => 'Area code',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'required' => false
            ))

        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));

    }

    /**
     * @return string
     */
    public function getName()
    {
        return get_class($this);
    }

}