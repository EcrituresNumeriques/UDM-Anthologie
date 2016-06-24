<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('born')
            ->add('bornRange')
            ->add('died')
            ->add('diedRange')
            ->add('activity')
            ->add('activityRange')
            ->add('bornCity')
            ->add('diedCity')
            ->add('era')
            ->add('entities')
            ->add('images')
            ->add('AuthorTranslations', CollectionType::class, array(
                'entry_type' => AuthorsTranslationsType::class
            ));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Authors',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return '';
    }
}