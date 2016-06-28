<?php

namespace AppBundle\Form;

use AppBundle\Entity\Images;
use Doctrine\Common\Collections\ArrayCollection;
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
    private $dynamicFields;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $this->options       = $options;
        $this->dynamicFields = ['bornCity' , 'diedCity' , 'era'];

        $builder
            ->add('born', IntegerType::class, array(
                'required' => false
            ))
            ->add('bornRange', IntegerType::class, array(
                'required' => false
            ))
            ->add('died', IntegerType::class, array(
                'required' => false
            ))
            ->add('diedRange', IntegerType::class, array(
                'required' => false
            ))
            ->add('activity', IntegerType::class, array(
                'required' => false
            ))
            ->add('activityRange', IntegerType::class, array(
                'required' => false
            ))
            ->add('bornCity' , CitiesType::class , array(
                'required' => false
            ))
            ->add('diedCity' , CitiesType::class , array(
                'required' => false
            ))
            ->add('era' , ErasType::class , array(
                'required' => false ,
            ))
            ->add('images' , EntityType::class , array(
                'class'    => 'AppBundle\Entity\Images' ,
                'required' => false ,
                'multiple' => true
            ))
            ->add('authorTranslations' , CollectionType::class , array(
                'entry_type'   => AuthorsTranslationsType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
            ))
            ->add('group')
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
            'data_class'         => 'AppBundle\Entity\Authors' ,
            'csrf_protection'    => false ,
            'allow_extra_fields' => true ,
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