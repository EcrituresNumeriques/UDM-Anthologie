<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KeywordsTypeTranslation
 *
 * @ORM\Table(name="keywords_type_translation")
 * @ORM\Entity
 */
class KeywordsTypeTranslation
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
     * @ORM\Column(name="label", type="text", length=65535, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;
    


}

