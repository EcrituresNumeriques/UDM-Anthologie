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
            );
    }

    public function onPreSubmitData (FormEvent $event)
    {
        $datas = $event->getData();
        $form  = $event->getForm();
        foreach ($this->dynamicFields as $field) {
            if (isset($datas[ $field ])) {
                if (is_int($datas[ $field ]) && !is_array($datas[ $field ])) {
                    $form->remove($datas[ $field ]);
                    $form->add($field);
                }
            }
        }

        //$form->setData($datas);
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