<?php
namespace AppBundle\Doctrine\Filter;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDeletableFilter extends SQLFilter
{

    public function addFilterConstraint (ClassMetadata $targetEntity , $targetTableAlias)
    {

        $reader           = new AnnotationReader();
        $softDeleteAware = $reader->getClassAnnotation($targetEntity->getReflectionClass() ,
            'AppBundle\\Annotation\\SoftDeleteMeta');
        if ( !$softDeleteAware ) {
            return '';
        }

        try {
            $softDelete = $this->getParameter('deleted') ? "IS NULL" : "IS NOT NULL" ;
        } catch (\InvalidArgumentException $e) {
            return '';
        }

        return sprintf('%s.%s %s' , $targetTableAlias , $softDeleteAware->deleteFlagTable , $softDelete);
    }

}