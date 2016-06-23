<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntitiesTranslations
 *
 * @ORM\Table(name="entities_translations")
 * @ORM\Entity
 */
class EntitiesTranslations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text_translated", type="string", length=45, nullable=true)
     */
    private $textTranslated;

}

