<?php


namespace AppBundle\Form\Type\Contact;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactShowType
 * @DI\Service("app.form.type.contact.create")
 * @DI\Tag("app.type", attributes={"alias" = "ContactCreateType"})
 * @package AppBundle\Form\Type\Contact
 * @author Tiko Banyini
 */
class ContactCreateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('privateEmail', 'text', array(
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
            ->add('cellphone', 'text', array(
                'label' => 'Mobile number',
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    public function getName()
    {
        return 'ContactCreateType';
    }

}