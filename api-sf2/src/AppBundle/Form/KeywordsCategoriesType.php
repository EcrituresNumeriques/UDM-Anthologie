<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeywordsCategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keywordCategoryTranslations' , CollectionType::class , array(
                'entry_type' => KeywordsCategoriesTranslationsType::class ,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->add('group');
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\KeywordsCategories' ,
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