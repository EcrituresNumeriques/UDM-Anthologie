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
            'AppBundle\Annotation\TranslatableMeta');

        if ( !$translationAware || !$translationAware->languageTable) {
            return '';
        }

        try {
            $language = $this->getParameter('lang');
        } catch (\InvalidArgumentException $e) {
            // No Lang have been defined
            return '';
        }
        //exit(\Doctrine\Common\Util\Debug::dump(sprintf('%s .......  %s.%s = %s', $targetEntity->getReflectionClass(), $targetTableAlias, $translationAware->languageTable, $this->getParameter('lang'))));
        $query = sprintf('%s.%s = %s', $targetTableAlias, $translationAware->languageTable, "2");
        return $query;
    }

}