<?php

namespace AppBundle\Form;

use AppBundle\Entity\UridCategories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UridType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
            ->add('uridSources', EntityType::class , array(
                'class' => 'AppBundle\Entity\UridSources' ,
                'required' => false ,
                'multiple' => false
            ))
            ->add('uridsCategories', EntityType::class , array(
                'class' => 'AppBundle\Entity\UridCategories' ,
                'required' => false ,
                'multiple' => false
            ))
            ->add('entity', EntityType::class , array(
                'class' => 'AppBundle\Entity\Entities' ,
                'required' => false ,
                'multiple' => false
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
            'data_class' => 'AppBundle\Entity\Urid',
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
