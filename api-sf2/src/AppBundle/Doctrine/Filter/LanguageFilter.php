<?php
namespace AppBundle\Doctrine\Filter;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class LanguageFilter extends SQLFilter
{

    public function addFilterConstraint (ClassMetadata $targetEntity , $targetTableAlias)
    {

        $reader           = new AnnotationReader();
        $translationAware = $reader->getClassAnnotation($targetEntity->getReflectionClass() ,
            'AppBundle\\Annotation\\TranslatableMeta');
        if ( !$translationAware ) {
            return '';
        }

        try {
            $language = $this->getParameter('lang');
        } catch (\InvalidArgumentException $e) {
            return '';
        }
        
        return sprintf('%s.%s = %s' , $targetTableAlias , $translationAware->languageTable , $language);
    }

}