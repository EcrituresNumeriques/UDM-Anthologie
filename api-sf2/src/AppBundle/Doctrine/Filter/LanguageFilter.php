<?php
namespace AppBundle\Doctrine\Filter;

use Doctrine\ORM\Mapping\ClassMetaData,
    Doctrine\ORM\Query\Filter\SQLFilter;

class LanguageFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        // Check if the entity implements the LocalAware interface
        if (!$targetEntity->reflClass->implementsInterface('LocaleAware')) {
            return "";
        }

        return $targetTableAlias.'.locale = ' . $this->getParameter('locale'); // getParameter applies quoting automatically
    }
}