<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorsTranslationsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $builder
            ->add('name' , TextType::class , array(
                'required' => true
            ))
            ->add('about' , TextType::class , array(
                'required' => false
            ))
            ->add('language' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Languages' ,
                'required' => true ,
                'multiple' => false
            ))
            ->add('group')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'AppBundle\Entity\AuthorsTranslations' ,
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
