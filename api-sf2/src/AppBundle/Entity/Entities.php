<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Entities
 *
 * @ORM\Table(name="entities")
 * @ORM\Entity
 */
class Entities
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="date", type="smallint", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_range", type="smallint", nullable=true)
     */
    private $dateRange;

    /**
     * @OneToMany(targetEntity="EntitiesTranslations", mappedBy="entity")
     */
    private $entityTranslations;

    /**
     * @ManyToOne(targetEntity="Books")
     * @JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;
    /**
     * @ManyToOne(targetEntity="Eras")
     * @JoinColumn(name="era_id", referencedColumnName="id")
     */
    private $era;
    /**
     * @ManyToOne(targetEntity="Genres")
     * @JoinColumn(name="genre_id", referencedColumnName="id")
     */
    private $genre;

    /**
     * @ManyToMany(targetEntity="Authors", inversedBy="entities")
     * @JoinTable(name="entities_authors_assoc")
     */
    private $authors;

    /**
     * @ManyToMany(targetEntity="Manuscripts", inversedBy="entities")
     * @JoinTable(name="entities_manuscripts_assoc")
     */
    private $manuscripts;

    /**
     * @ManyToMany(targetEntity="Keywords", inversedBy="entities")
     * @JoinTable(name="entities_keywords_assoc")
     */
    private $keywords;

    /**
     * @ManyToMany(targetEntity="Motifs", inversedBy="entities")
     * @JoinTable(name="entities_motifs_assoc")
     */
    private $motifs;

    /**
     * @ManyToMany(targetEntity="Scholies", inversedBy="entities")
     * @JoinTable(name="entities_scholies_assoc")
     */
    private $scholies;

    /**
     * @ManyToMany(targetEntity="Notes", inversedBy="entities")
     * @JoinTable(name="entities_notes_assoc")
     */
    private $notes;

    /**
     * @ManyToMany(targetEntity="Texts", inversedBy="entities")
     * @JoinTable(name="entities_texts_assoc")
     */
    private $texts;

    public function __construct ()
    {
        $this->entityTranslations = new ArrayCollection();
        $this->authors            = new ArrayCollection();
        $this->manuscripts        = new ArrayCollection();
        $this->keywords           = new ArrayCollection();
        $this->motifs             = new ArrayCollection();
        $this->scholies           = new ArrayCollection();
        $this->notes              = new ArrayCollection();
        $this->texts              = new ArrayCollection();
    }

}

