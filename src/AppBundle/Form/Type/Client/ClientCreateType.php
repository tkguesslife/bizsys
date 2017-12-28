<?php


namespace AppBundle\Form\Type\Client;


use AppBundle\Form\Type\Party\PartyCreateType;
use Symfony\Component\Form\AbstractType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ClientCreateType
 * @DI\Service("app.form.type.client.create")
 * @DI\Tag("form.type", attributes={"alias" = "ClientCreateType"})
 * @package AppBundle\Form\Type\Client
 * @author Tiko Banyini
 */
class ClientCreateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('party', new PartyCreateType())

            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ClientCreateType';
    }

}