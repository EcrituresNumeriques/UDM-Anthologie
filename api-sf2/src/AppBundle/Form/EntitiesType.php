<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitiesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('date')
            ->add('dateRange')
            ->add('book')
            ->add('era')
            ->add('genre')
            ->add('user')
            ->add('group')
            ->add('authors')
            ->add('manuscripts')
            ->add('keywords')
            ->add('motifs')
            ->add('scholies')
            ->add('notes')
            ->add('texts')
            ->add('images')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Entities'
        ));
    }
}
