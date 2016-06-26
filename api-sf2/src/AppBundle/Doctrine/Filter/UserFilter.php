<?php
namespace AppBundle\Doctrine\Filter;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class UserFilter extends SQLFilter
{

    public function addFilterConstraint (ClassMetadata $targetEntity , $targetTableAlias)
    {

        $reader           = new AnnotationReader();
        $userAware = $reader->getClassAnnotation($targetEntity->getReflectionClass() ,
            'AppBundle\\Annotation\\UserMeta');
        if ( !$userAware ) {
            return '';
        }

        try {
            $userId = $this->getParameter('userId');
        } catch (\InvalidArgumentException $e) {
            return '';
        }
        return sprintf('%s.%s = %s' , $targetTableAlias , $userAware->userTable , $userId);
    }

}