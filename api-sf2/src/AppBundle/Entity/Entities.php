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


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Entities
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return Entities
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateRange
     *
     * @param integer $dateRange
     *
     * @return Entities
     */
    public function setDateRange($dateRange)
    {
        $this->dateRange = $dateRange;

        return $this;
    }

    /**
     * Get dateRange
     *
     * @return integer
     */
    public function getDateRange()
    {
        return $this->dateRange;
    }

    /**
     * Add entityTranslation
     *
     * @param \AppBundle\Entity\EntitiesTranslations $entityTranslation
     *
     * @return Entities
     */
    public function addEntityTranslation(\AppBundle\Entity\EntitiesTranslations $entityTranslation)
    {
        $this->entityTranslations[] = $entityTranslation;

        return $this;
    }

    /**
     * Remove entityTranslation
     *
     * @param \AppBundle\Entity\EntitiesTranslations $entityTranslation
     */
    public function removeEntityTranslation(\AppBundle\Entity\EntitiesTranslations $entityTranslation)
    {
        $this->entityTranslations->removeElement($entityTranslation);
    }

    /**
     * Get entityTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntityTranslations()
    {
        return $this->entityTranslations;
    }

    /**
     * Set book
     *
     * @param \AppBundle\Entity\Books $book
     *
     * @return Entities
     */
    public function setBook(\AppBundle\Entity\Books $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Books
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set era
     *
     * @param \AppBundle\Entity\Eras $era
     *
     * @return Entities
     */
    public function setEra(\AppBundle\Entity\Eras $era = null)
    {
        $this->era = $era;

        return $this;
    }

    /**
     * Get era
     *
     * @return \AppBundle\Entity\Eras
     */
    public function getEra()
    {
        return $this->era;
    }

    /**
     * Set genre
     *
     * @param \AppBundle\Entity\Genres $genre
     *
     * @return Entities
     */
    public function setGenre(\AppBundle\Entity\Genres $genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \AppBundle\Entity\Genres
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Authors $author
     *
     * @return Entities
     */
    public function addAuthor(\AppBundle\Entity\Authors $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\Authors $author
     */
    public function removeAuthor(\AppBundle\Entity\Authors $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Add manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     *
     * @return Entities
     */
    public function addManuscript(\AppBundle\Entity\Manuscripts $manuscript)
    {
        $this->manuscripts[] = $manuscript;

        return $this;
    }

    /**
     * Remove manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     */
    public function removeManuscript(\AppBundle\Entity\Manuscripts $manuscript)
    {
        $this->manuscripts->removeElement($manuscript);
    }

    /**
     * Get manuscripts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManuscripts()
    {
        return $this->manuscripts;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     *
     * @return Entities
     */
    public function addKeyword(\AppBundle\Entity\Keywords $keyword)
    {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     */
    public function removeKeyword(\AppBundle\Entity\Keywords $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Add motif
     *
     * @param \AppBundle\Entity\Motifs $motif
     *
     * @return Entities
     */
    public function addMotif(\AppBundle\Entity\Motifs $motif)
    {
        $this->motifs[] = $motif;

        return $this;
    }

    /**
     * Remove motif
     *
     * @param \AppBundle\Entity\Motifs $motif
     */
    public function removeMotif(\AppBundle\Entity\Motifs $motif)
    {
        $this->motifs->removeElement($motif);
    }

    /**
     * Get motifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifs()
    {
        return $this->motifs;
    }

    /**
     * Add scholy
     *
     * @param \AppBundle\Entity\Scholies $scholy
     *
     * @return Entities
     */
    public function addScholy(\AppBundle\Entity\Scholies $scholy)
    {
        $this->scholies[] = $scholy;

        return $this;
    }

    /**
     * Remove scholy
     *
     * @param \AppBundle\Entity\Scholies $scholy
     */
    public function removeScholy(\AppBundle\Entity\Scholies $scholy)
    {
        $this->scholies->removeElement($scholy);
    }

    /**
     * Get scholies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScholies()
    {
        return $this->scholies;
    }

    /**
     * Add note
     *
     * @param \AppBundle\Entity\Notes $note
     *
     * @return Entities
     */
    public function addNote(\AppBundle\Entity\Notes $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \AppBundle\Entity\Notes $note
     */
    public function removeNote(\AppBundle\Entity\Notes $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Add text
     *
     * @param \AppBundle\Entity\Texts $text
     *
     * @return Entities
     */
    public function addText(\AppBundle\Entity\Texts $text)
    {
        $this->texts[] = $text;

        return $this;
    }

    /**
     * Remove text
     *
     * @param \AppBundle\Entity\Texts $text
     */
    public function removeText(\AppBundle\Entity\Texts $text)
    {
        $this->texts->removeElement($text);
    }

    /**
     * Get texts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTexts()
    {
        return $this->texts;
    }
}
