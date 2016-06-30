<?php
namespace AppBundle\Doctrine\Filter;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class GroupFilter extends SQLFilter
{

    public function addFilterConstraint (ClassMetadata $targetEntity , $targetTableAlias)
    {

        $reader           = new AnnotationReader();
        $groupAware = $reader->getClassAnnotation($targetEntity->getReflectionClass() ,
            'AppBundle\\Annotation\\GroupMeta');
        if ( !$groupAware ) {
            return '';
        }

        try {
            $groupId = $this->getParameter('groupId');
        } catch (\InvalidArgumentException $e) {
            return '';
        }
        return sprintf('%s.%s = %s' , $targetTableAlias , $groupAware->groupTable , $groupId);
    }

}