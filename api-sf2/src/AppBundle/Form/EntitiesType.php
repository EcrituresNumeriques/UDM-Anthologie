<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitiesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $builder
            ->add('title')
            ->add('date')
            ->add('dateRange')
            ->add('book')
            ->add('era')
            ->add('genre')
            ->add('group')
            ->add('authors')
            ->add('manuscripts')
            ->add('keywords')
            ->add('motifs')
            ->add('scholies')
            ->add('notes')
            ->add('texts')
            ->add('images')
            ->add('entityTranslations' , CollectionType::class , array(
                'entry_type'   => EntitiesTranslationsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'AppBundle\Entity\Entities' ,
            'csrf_protection'    => false ,
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
