<?php

namespace AppBundle\Form;

use AppBundle\Entity\Manuscripts;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitiesType extends AbstractType
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
            "era"   => ErasType::class ,
            "genre" => GenresType::class ,
        ];
        $this->arrayFieldTransformer = [
            "images"             => ImagesType::class ,
            "authors"            => AuthorsType::class ,
            "manuscripts"        => ManuscriptsType::class ,
            "keywords"           => KeywordsType::class ,
            "motifs"             => MotifsType::class ,
            "scholies"           => ScholiesType::class ,
            "notes"              => NotesType::class ,
            "texts"              => TextType::class ,
            "entityTranslations" => EntitiesTranslationsType::class ,
        ];

        $this->options = $options;
        $builder
            ->add('title' , TextType::class , array(
                'required' => true
            ))
            ->add('date')
            ->add('dateRange')
            ->add('group')
            ->add('book' , BooksType::class , array(
                'required' => false
            ))
            ->add('era' , ErasType::class , array(
                'required' => false
            ))
            ->add('genre' , GenresType::class , array(
                'required' => false
            ))
            ->add('authors' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Authors' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('manuscripts' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Manuscripts' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('keywords' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Keywords' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('motifs' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Motifs' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('scholies' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Scholies' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('notes' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Notes' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('texts' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Texts' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('images' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('entityTranslations' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\EntitiesTranslations' ,
                'required' => false ,
                'multiple' => true
            ))
            ->addEventListener(
                FormEvents::PRE_SUBMIT ,
                array($this , 'onPreSubmitData')
            )
        ;
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
