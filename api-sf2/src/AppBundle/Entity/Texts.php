<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Texts
 *
 * @ORM\Table(name="texts")
 * @ORM\Entity
 */
class Texts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_text", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idText;


}

