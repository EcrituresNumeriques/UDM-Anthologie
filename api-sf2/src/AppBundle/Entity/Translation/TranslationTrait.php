<?php
namespace AppBundle\Entity\Translation;

use Knp\DoctrineBehaviors\Model\Translatable\Translation;

trait TranslationTrait
{
    use Translation;

    /**
     * @inheritdoc
     */
    public static function getTranslatableEntityClass()
    {
        $explodedNamespace = explode('\\', __CLASS__);
        $entityClass = array_pop($explodedNamespace);
        // Remove Translation namespace
        array_pop($explodedNamespace);
        return '\\'.implode('\\', $explodedNamespace).'\\'.substr($entityClass, 0, -11);
    }
}