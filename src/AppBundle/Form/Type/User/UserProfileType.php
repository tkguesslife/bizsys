<?php
namespace AppBundle\Form\Type\User;

use AppBundle\Form\Type\Organisation\OrganisationShowType;
use AppBundle\Form\Type\Party\PartyShowType;
use Symfony\Component\Form\AbstractType;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Class UserProfileType
 * @DI\Service("app.form.type.user_profile")
 * @DI\Tag("form.type", attributes={"alias" = "UserProfileType"} )
 * @package AppBundle\Form\Type\User
 * @author Tiko Banyini
 */
class UserProfileType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
                ->add('party', new PartyShowType())
                ->add('organisation', new OrganisationShowType())
                ->add('createdAt', 'datetime', array(
                    'label' => 'Created At ',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd  HH:m:s a',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'disabled' => true,
                ))

                ->add('updatedAt', 'datetime', array(
                    'label' => 'Updated At ',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd  HH:m:s a',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'disabled' => true,
                ))

                ->add('lastLogin', 'datetime', array(
                    'label' => 'Last login At ',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd  HH:m:s a',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'disabled' => true,
                ))

                ->add('createdBy', 'entity', array(
                    'placeholder' => 'Select a gender',
                    'class' => 'AppBundle:User',
                    'label' => 'Created By ',
                    'placeholder' => 'Default System user',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'disabled' => true,
                ))
                ;
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'UserProfileType';
    }
}