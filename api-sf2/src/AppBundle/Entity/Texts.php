<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Texts
 *
 * @ORM\Table(name="texts")
 * @ORM\Entity
 */
class Texts
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
     * @OneToMany(targetEntity="AppBundle\Entity\NotesTranslations", mappedBy="text")
     */
    private $textTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="texts")
     */
    private $entities;

    public function __construct ()
    {
        $this->textTranslations = new ArrayCollection();
        $this->entities         = new ArrayCollection();
    }
}

