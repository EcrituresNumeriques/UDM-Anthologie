<?php

namespace AppBundle\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class UserMeta
{
    public $userTable;
}