<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManuscriptsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entities', EntityType::class , array(
                'class' => 'AppBundle\Entity\Entities' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('scholies', EntityType::class , array(
                'class' => 'AppBundle\Entity\Scholies' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('images', EntityType::class , array(
                'class' => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('manuscriptTranslations' , CollectionType::class , array(
                'entry_type' => ManuscriptsTranslationsType::class ,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false

            ))
            ->add('group')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Manuscripts',
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName ()
    {
        return '';
    }
}
