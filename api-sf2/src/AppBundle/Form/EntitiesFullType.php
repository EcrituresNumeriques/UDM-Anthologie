<?php

namespace AppBundle\Form;

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
    
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm (FormBuilderInterface $builder , array $options)
    {
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

        if (is_int($datas['book'])){
            $form->remove($datas['book']);
            $form->add('book');
        }
        if (is_int($datas['era'])){
            $form->remove($datas['era']);
            $form->add('era');
        }
        if (is_int($datas['genre'])){
            $form->remove($datas['genre']);
            $form->add('genre');
        }
        if (is_int($datas['authors'])){
            $form->remove($datas['authors']);
            $form->add('authors');
        }
        if (is_int($datas['manuscripts'])){
            $form->remove($datas['manuscripts']);
            $form->add('manuscripts');
        }
        if (is_int($datas['keywords'])){
            $form->remove($datas['keywords']);
            $form->add('keywords');
        }
        if (is_int($datas['motifs'])){
            $form->remove($datas['motifs']);
            $form->add('motifs');
        }
        if (is_int($datas['scholies'])){
            $form->remove($datas['scholies']);
            $form->add('scholies');
        }        
        if (is_int($datas['notes'])){
            $form->remove($datas['notes']);
            $form->add('notes');
        }        
        if (is_int($datas['texts'])){
            $form->remove($datas['texts']);
            $form->add('texts');
        }
        if (is_int($datas['images'])){
            $form->remove($datas['images']);
            $form->add('images');
        }
        
        $form->setData($datas);
        //exit(\Doctrine\Common\Util\Debug::dump($datas));
    }

    public function onPostSubmitData (FormEvent $event)
    {
        if ($this->options['method'] == "POST") {
            $entity = $event->getData();
            $entity->getBook()->setUser($entity->getUser());
            $entity->getEra()->setUser($entity->getUser());
            $entity->getGenre()->setUser($entity->getUser());
            foreach ($entity->getAuthors() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getManuscripts() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getKeywords() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getMotifs() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getScholies() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getNotes() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getTexts() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
            }
            foreach ($entity->getImages() as $numObject => $object)
            {
                $object->setUser($entity->getUser());
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
