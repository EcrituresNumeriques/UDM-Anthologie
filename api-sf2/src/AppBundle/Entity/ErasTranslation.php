<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErasTranslation
 *
 * @ORM\Table(name="eras_translation")
 * @ORM\Entity
 */
class ErasTranslation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_era_name", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idEraName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="culture_centers", type="text", length=65535, nullable=true)
     */
    private $cultureCenters;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;
    
}

