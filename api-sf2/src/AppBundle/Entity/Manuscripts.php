<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Manuscripts
 *
 * @ORM\Table(name="manuscripts")
 * @ORM\Entity
 */
class Manuscripts
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
     * @OneToMany(targetEntity="AppBundle\Entity\ManuscriptsTranslations", mappedBy="manuscript")
     */
    private $manuscriptTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="manuscripts")
     *
     */
    private $entities;
    
    /**
     * @ManyToMany(targetEntity="Scholies", inversedBy="manuscripts")
     * @JoinTable(name="manuscripts_scholies_assoc")
     */
    private $scholies;

    /**
     * @ManyToMany(targetEntity="Images")
     * @JoinTable(name="manuscripts_images",
     *      joinColumns={@JoinColumn(name="manuscript_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->manuscriptTranslations = new ArrayCollection();
        $this->entities               = new ArrayCollection();
        $this->scholies               = new ArrayCollection();
        $this->images                 = new ArrayCollection();
    }
}

