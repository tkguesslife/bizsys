<?php


namespace AppBundle\Form\Type\Organisation;


use AppBundle\Form\Type\Party\PartyShowType;
use Symfony\Component\Form\AbstractType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class OrganisationShowType
 * @DI\Service("app.form.type.organisation.show")
 * @DI\Tag(name="app.form", attributes={"alias"="OrganisationShowType"})
 * @package AppBundle\Form\Type\Organisation
 * @author Tiko Banyini
 */
class OrganisationShowType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('party', new PartyShowType())
            ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Organisation'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'OrganisationShowType';
    }

}