<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Notes
 *
 * @ORM\Table(name="notes")
 * @ORM\Entity
 */
class Notes
{
    use ORMBehaviors\SoftDeletable\SoftDeletable ,
        ORMBehaviors\Timestampable\Timestampable;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @OneToMany(targetEntity="AppBundle\Entity\NotesTranslations", mappedBy="note")
     */
    private $noteTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="notes")
     */
    private $entities;

    public function __construct ()
    {
        $this->noteTranslations = new ArrayCollection();
        $this->entities         = new ArrayCollection();
    }

}