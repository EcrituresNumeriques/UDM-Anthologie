<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitiesType extends AbstractType
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
            "images"           => ImagesType::class ,
            "cityTranslations" => CitiesTranslationsType::class ,
        ];

        $builder
            ->add('gps')
            ->add('images' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('cityTranslations' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\CitiesTranslations' ,
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
                if (isset($field) && !is_int($fields[ $fieldKey ])) {
                    $fieldValue = $fields[ $fieldKey ];
                    $form->remove($fieldKey);
                    $form->add($fieldKey ,
                        $this->simpleFieldTranformer[ $fieldKey ]);
                    $fields[ $fieldKey ] = $fieldValue;
                }
            }
            if (array_key_exists($fieldKey , $this->arrayFieldTransformer)) {
                if (isset($field) && is_array($field)) {
                    foreach ($field as $subField) {
                        if (isset($subField) && !is_int($subField)) {
                            $fieldValue = $fields[ $fieldKey ];
                            $form->remove($fieldKey);
                            $form->add($fieldKey , CollectionType::class , array(
                                'entry_type'   => $this->arrayFieldTransformer[ $fieldKey ] ,
                                'allow_add'    => true ,
                                'allow_delete' => true ,
                                'by_reference' => false
                            ));
                            $fields[ $fieldKey ] = $fieldValue;

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
            'data_class'         => 'AppBundle\Entity\Cities' ,
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
