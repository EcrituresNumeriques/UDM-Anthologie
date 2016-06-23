<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Motifs
 *
 * @ORM\Table(name="motifs")
 * @ORM\Entity
 */
class Motifs
{
    use ORMBehaviors\SoftDeletable\SoftDeletable ,
        ORMBehaviors\Timestampable\Timestampable;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @OneToMany(targetEntity="AppBundle\Entity\MotifsTranslations", mappedBy="motif")
     */
    private $motifTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="motifs")
     */
    private $entities;

    public function __construct ()
    {
        $this->motifTranslations = new ArrayCollection();
        $this->entities          = new ArrayCollection();
    }
}

