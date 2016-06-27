<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitiesType extends AbstractType
{

    private $options;
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;
        
        $builder
            ->add('gps')
            ->add('images', CollectionType::class , array(
                'entry_type' => CitiesTranslationsType::class ,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->add('cityTranslations' , CollectionType::class , array(
                'entry_type' => CitiesTranslationsType::class ,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->add('group')
            ->addEventListener(
                FormEvents::POST_SUBMIT ,
                array($this , 'onPostSubmitData')
            );
        ;
    }

    public function onPostSubmitData (FormEvent $event)
    {
        if ($this->options['method'] == "POST") {
            $city = $event->getData();
            foreach ($city->getImages() as $numObject => $object)
            {
                $object->setUser($city->getUser());
            }
        }
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => 'AppBundle\Entity\Cities' ,
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
