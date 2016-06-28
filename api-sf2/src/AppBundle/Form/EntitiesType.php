<?php

namespace AppBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntitiesType extends AbstractType
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


        $this->options = $options;
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

            ->add('authors', EntityType::class , array(
            'class'    => 'AppBundle\Entity\Authors' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('manuscripts', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Manuscripts' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('keywords', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Keywords' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('motifs', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Motifs' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('scholies', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Scholies' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('notes', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Notes' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('texts', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Texts' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('images', EntityType::class , array(
                'class'    => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
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
