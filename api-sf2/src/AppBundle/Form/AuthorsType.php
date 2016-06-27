<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorsType extends AbstractType
{

    private $options;

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
        $this->options = $options;

        $builder
            ->add('born')
            ->add('bornRange')
            ->add('died')
            ->add('diedRange')
            ->add('activity')
            ->add('activityRange')
            ->add('bornCity' , CitiesType::class , array(
                'required' => false
            ))
            ->add('diedCity' , CitiesType::class , array(
                'required' => false
            ))
            ->add('era' , ErasType::class , array(
                'required' => false
            ))
            ->add('images' , CollectionType::class , array(
                'entry_type'   => ImagesType::class ,
                'allow_add'    => true ,
                'allow_delete' => true ,
                'by_reference' => false
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

         if (is_int($datas['bornCity'])){
             $form->remove($datas['bornCity']);
             $form->add('bornCity');
         }
        if (is_int($datas['diedCity'])){
            $form->remove($datas['diedCity']);
            $form->add('diedCity');
        }
        if (is_int($datas['era'])){
            $form->remove($datas['era']);
            $form->add('era');
        }
        $form->setData($datas);
        //exit(\Doctrine\Common\Util\Debug::dump($datas));
    }

    public function onPostSubmitData (FormEvent $event)
    {
        $author = $event->getData();
        if ($this->options['method'] == "POST") {
            $author->getBornCity()->setUser($author->getUser());
            $author->getDiedCity()->setUser($author->getUser());
            $author->getEra()->setUser($author->getUser());
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