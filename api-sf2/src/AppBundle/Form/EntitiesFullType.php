<?php

namespace AppBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitiesFullType extends AbstractType
{

    private $options;
    private $dynamicFields;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $this->options       = $options;
        $this->dynamicFields = ['book' , 'era' , 'genre', 'authors', 'manuscripts',
            'keywords', 'motifs', 'scholies', 'notes','texts','images'];
        
        $builder
            ->add('title', TextType::class, array(
                'required' => true
            ))
            ->add('date')
            ->add('dateRange')
            ->add('group')
            ->add('book', BooksType::class , array(
                'required' => false
            ))
            ->add('era', ErasType::class , array(
                'required' => false
            ))
            ->add('genre', GenresType::class , array(
                'required' => false
            ))
            
            ->add('authors', AuthorsType::class , array(
                'entry_type'   => AuthorsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('manuscripts', CollectionType::class , array(
                'entry_type'   => ManuscriptsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('keywords', CollectionType::class , array(
                'entry_type'   => KeywordsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('motifs', CollectionType::class , array(
                'entry_type'   => MotifsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('scholies', CollectionType::class , array(
                'entry_type'   => ScholiesType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('notes', CollectionType::class , array(
                'entry_type'   => NotesType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('texts', CollectionType::class , array(
                'entry_type'   => TextsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('images', CollectionType::class , array(
                'entry_type'   => ImagesType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('entityTranslations' , CollectionType::class , array(
                'entry_type'   => EntitiesTranslationsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))

            ->addEventListener(
                FormEvents::PRE_SUBMIT ,
                array($this , 'onPreSubmitData')
            )
            ->addEventListener(
                FormEvents::POST_SUBMIT ,
                array($this , 'onPostSubmitData')
            );
    }

    public function onPreSubmitData (FormEvent $event)
    {
        $datas = $event->getData();
        $form  = $event->getForm();


        foreach ($this->dynamicFields as $field) {
            if (isset($datas[ $field ])) {
                if (is_int($datas[ $field ])) {
                    $form->remove($datas[ $field ]);
                    $form->add($field);
                }
            }
        }
        $form->setData($datas);
    }

    public function onPostSubmitData (FormEvent $event)
    {
        if ($this->options['method'] == "POST") {
            $object = $event->getData();
            foreach ($this->dynamicFields AS $subEntityGetter) {
                $method = "get" . ucfirst($subEntityGetter);
                if (empty($object->$method()) || !method_exists($object , $method)) {
                    continue;
                }

                if ($object->$method() instanceof ArrayCollection) {
                    foreach ($object->$method() as $subObject) {
                        if (method_exists($subObject , "setUser") && empty($subObject->getUser())) {
                            $subObject->setUser($object->getUser());
                        }
                    }
                } else {
                    if (is_object($object->$method()) && empty($object->$method()->getUser())) {
                        $object->$method()->setUser($object->getUser());
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
