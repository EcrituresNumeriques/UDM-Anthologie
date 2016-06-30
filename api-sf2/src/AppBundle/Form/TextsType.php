<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextsType extends AbstractType
{
    private $options;
    private $simpleFieldTranformer;
    private $arrayFieldTransformer;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $this->options               = $options;
        $this->simpleFieldTranformer = [];
        $this->arrayFieldTransformer = [
            "entities"         => EntitiesType::class ,
            "textTranslations" => TextsTranslationsType::class ,
        ];

        $builder
            ->add('entities' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Entities' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('textTranslations' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\TextsTranslations' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('group');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'AppBundle\Entity\Texts' ,
            'csrf_protection'    => false ,
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
