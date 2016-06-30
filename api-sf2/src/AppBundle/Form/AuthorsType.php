<?php

namespace AppBundle\Form;

use AppBundle\Entity\Images;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorsType extends AbstractType
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
        $this->simpleFieldTranformer = [
            "bornCity" => CitiesType::class ,
            "diedCity" => CitiesType::class ,
            "era"      => ErasType::class ,
        ];
        $this->arrayFieldTransformer = [
            "images"             => ImagesType::class ,
            "authorTranslations" => AuthorsTranslationsType::class ,
        ];

        $builder
            ->add('born' , IntegerType::class , array(
                'required' => false
            ))
            ->add('bornRange' , IntegerType::class , array(
                'required' => false
            ))
            ->add('died' , IntegerType::class , array(
                'required' => false
            ))
            ->add('diedRange' , IntegerType::class , array(
                'required' => false
            ))
            ->add('activity' , IntegerType::class , array(
                'required' => false
            ))
            ->add('activityRange' , IntegerType::class , array(
                'required' => false
            ))
            ->add('bornCity' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Cities' ,
                'required' => false ,
                'multiple' => false
            ))
            ->add('diedCity' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Cities' ,
                'required' => false ,
                'multiple' => false
            ))
            ->add('era' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Eras' ,
                'required' => false ,
                'multiple' => false
            ))
            ->add('images' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('authorTranslations' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\AuthorsTranslations' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('group')
            ->addEventListener(
                FormEvents::PRE_SUBMIT ,
                array($this , 'onPreSubmitData')
            );
    }

    public function onPreSubmitData (FormEvent $event)
    {
        $fields = $event->getData();
        $form   = $event->getForm();

        foreach ($fields as $fieldKey => $field) {
            if (array_key_exists($fieldKey , $this->simpleFieldTranformer)) {
                if (isset($field) && !is_int($fields[$fieldKey])) {
                    $fieldValue = $fields[$fieldKey];
                    $form->remove($fieldKey);
                    $form->add($fieldKey ,
                        $this->simpleFieldTranformer[ $fieldKey ]);
                    $fields[$fieldKey] = $fieldValue;
                }
            }
            if (array_key_exists($fieldKey , $this->arrayFieldTransformer)) {
                if (isset($field) && is_array($field)) {
                    foreach ($field as $subField) {
                        if (isset($subField) && !is_int($subField)) {
                            $fieldValue = $fields[$fieldKey];
                            $form->remove($fieldKey);
                            $form->add($fieldKey, CollectionType::class , array(
                                'entry_type'   => $this->arrayFieldTransformer[ $fieldKey ] ,
                                'allow_add'    => true ,
                                'allow_delete' => true ,
                                'by_reference' => false
                            ));
                            $fields[$fieldKey] = $fieldValue;

                        }
                    }
                }
            }
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'AppBundle\Entity\Authors' ,
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