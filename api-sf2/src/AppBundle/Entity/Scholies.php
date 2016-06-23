<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Scholies
 *
 * @ORM\Table(name="scholies")
 * @ORM\Entity
 */
class Scholies
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
     * @OneToMany(targetEntity="AppBundle\Entity\NotesTranslations", mappedBy="scholie")
     */
    private $scholieTranslations;

    /**
     * @ManyToMany(targetEntity="Manuscripts", mappedBy="scholies")
     */
    private $manuscripts;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="scholies")
     */
    private $entities;

    public function __construct ()
    {
        $this->scholieTranslations = new ArrayCollection();
        $this->manuscripts         = new ArrayCollection();
        $this->entities            = new ArrayCollection();
    }
}

