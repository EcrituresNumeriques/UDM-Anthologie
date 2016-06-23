<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScholiesTranslations
 *
 * @ORM\Table(name="scholies_translations")
 * @ORM\Entity
 */
class ScholiesTranslations
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
     * @ORM\Column(name="text_translated", type="text", length=65535, nullable=true)
     */
    private $textTranslated;
}

