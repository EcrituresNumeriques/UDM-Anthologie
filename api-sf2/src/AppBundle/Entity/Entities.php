<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
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
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
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
     * @ManyToOne(targetEntity="Books", inversedBy="entities", cascade={"persist"})
     * @JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @ManyToOne(targetEntity="Eras", inversedBy="entities", cascade={"persist"})
     * @JoinColumn(name="era_id", referencedColumnName="id")
     */
    private $era;
    /**
     * @ManyToOne(targetEntity="Genres", inversedBy="entities", cascade={"persist"})
     * @JoinColumn(name="genre_id", referencedColumnName="id")
     */
    private $genre;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="entities")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="entities")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="EntitiesTranslations", mappedBy="entity", cascade={"persist"})
     */
    private $entityTranslations;

    /**
     * @OneToMany(targetEntity="Uri", mappedBy="entity", cascade={"persist"})
     */
    private $uris;

    /**
     * @ManyToMany(targetEntity="Authors", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_authors_assoc")
     */
    private $authors;

    /**
     * @ManyToMany(targetEntity="Manuscripts", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_manuscripts_assoc")
     */
    private $manuscripts;

    /**
     * @ManyToMany(targetEntity="Keywords", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_keywords_assoc")
     */
    private $keywords;

    /**
     * @ManyToMany(targetEntity="Motifs", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_motifs_assoc")
     */
    private $motifs;

    /**
     * @ManyToMany(targetEntity="Scholies", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_scholies_assoc")
     */
    private $scholies;

    /**
     * @ManyToMany(targetEntity="Notes", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_notes_assoc")
     */
    private $notes;

    /**
     * @ManyToMany(targetEntity="Texts", inversedBy="entities", cascade={"persist"})
     * @JoinTable(name="entities_texts_assoc")
     */
    private $texts;

    /**
     * @ManyToMany(targetEntity="Images", cascade={"persist"})
     * @JoinTable(name="entities_images_assoc",
     *      joinColumns={@JoinColumn(name="entity_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

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
        $this->uris               = new ArrayCollection();
        $this->images             = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Entities
     */
    public function setTitle ($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate ()
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return Entities
     */
    public function setDate ($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get dateRange
     *
     * @return integer
     */
    public function getDateRange ()
    {
        return $this->dateRange;
    }

    /**
     * Set dateRange
     *
     * @param integer $dateRange
     *
     * @return Entities
     */
    public function setDateRange ($dateRange)
    {
        $this->dateRange = $dateRange;

        return $this;
    }

    /**
     * Add entityTranslation
     *
     * @param \AppBundle\Entity\EntitiesTranslations $entityTranslation
     *
     * @return Entities
     */
    public function addEntityTranslation (\AppBundle\Entity\EntitiesTranslations $entityTranslation)
    {
        if (empty($entityTranslation->getUser())) {
            $entityTranslation->setUser($this->getUser());
        }
        $entityTranslation->setEntity($this);
        $this->entityTranslations[] = $entityTranslation;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Entities
     */
    public function setUser (\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Remove entityTranslation
     *
     * @param \AppBundle\Entity\EntitiesTranslations $entityTranslation
     */
    public function removeEntityTranslation (\AppBundle\Entity\EntitiesTranslations $entityTranslation)
    {
        $this->entityTranslations->removeElement($entityTranslation);
    }

    /**
     * Get entityTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntityTranslations ()
    {
        return $this->entityTranslations;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Books
     */
    public function getBook ()
    {
        return $this->book;
    }

    /**
     * Set book
     *
     * @param \AppBundle\Entity\Books $book
     *
     * @return Entities
     */
    public function setBook (\AppBundle\Entity\Books $book = null)
    {

        if (empty($book->getUser())) {
            $book->setUser($this->getUser());
        }
        $this->book = $book;

        return $this;
    }

    /**
     * Get era
     *
     * @return \AppBundle\Entity\Eras
     */
    public function getEra ()
    {

        return $this->era;
    }

    /**
     * Set era
     *
     * @param \AppBundle\Entity\Eras $era
     *
     * @return Entities
     */
    public function setEra (\AppBundle\Entity\Eras $era = null)
    {
        if (empty($era->getUser())) {
            $era->setUser($this->getUser());
        }
        $this->era = $era;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \AppBundle\Entity\Genres
     */
    public function getGenre ()
    {
        return $this->genre;
    }

    /**
     * Set genre
     *
     * @param \AppBundle\Entity\Genres $genre
     *
     * @return Entities
     */
    public function setGenre (\AppBundle\Entity\Genres $genre = null)
    {
        if (empty($genre->getUser())) {
            $genre->setUser($this->getUser());
        }
        $this->genre = $genre;

        return $this;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Authors $author
     *
     * @return Entities
     */
    public function addAuthor (\AppBundle\Entity\Authors $author)
    {
        if (empty($author->getUser())) {
            $author->setUser($this->getUser());
        }
        $author->addEntity($this);
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\Authors $author
     */
    public function removeAuthor (\AppBundle\Entity\Authors $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors ()
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
    public function addManuscript (\AppBundle\Entity\Manuscripts $manuscript)
    {
        if (empty($manuscript->getUser())) {
            $manuscript->setUser($this->getUser());
        }
        $manuscript->addEntity($this);
        $this->manuscripts[] = $manuscript;

        return $this;
    }

    /**
     * Remove manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     */
    public function removeManuscript (\AppBundle\Entity\Manuscripts $manuscript)
    {
        $this->manuscripts->removeElement($manuscript);
    }

    /**
     * Get manuscripts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManuscripts ()
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
    public function addKeyword (\AppBundle\Entity\Keywords $keyword)
    {
        if (empty($keyword->getUser())) {
            $keyword->setUser($this->getUser());
        }
        $keyword->addEntity($this);
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     */
    public function removeKeyword (\AppBundle\Entity\Keywords $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords ()
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
    public function addMotif (\AppBundle\Entity\Motifs $motif)
    {
        if (empty($motif->getUser())) {
            $motif->setUser($this->getUser());
        }
        $motif->addEntity($this);
        $this->motifs[] = $motif;

        return $this;
    }

    /**
     * Remove motif
     *
     * @param \AppBundle\Entity\Motifs $motif
     */
    public function removeMotif (\AppBundle\Entity\Motifs $motif)
    {
        $this->motifs->removeElement($motif);
    }

    /**
     * Get motifs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifs ()
    {
        return $this->motifs;
    }

    /**
     * Add scholie
     *
     * @param \AppBundle\Entity\Scholies $scholie
     *
     * @return Entities
     */
    public function addScholie (\AppBundle\Entity\Scholies $scholie)
    {
        if (empty($scholie->getUser())) {
            $scholie->setUser($this->getUser());
        }
        $scholie->addEntity($this);
        $this->scholies[] = $scholie;

        return $this;
    }

    /**
     * Remove scholie
     *
     * @param \AppBundle\Entity\Scholies $scholie
     */
    public function removeScholie (\AppBundle\Entity\Scholies $scholie)
    {
        $this->scholies->removeElement($scholie);
    }

    /**
     * Get scholies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScholies ()
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
    public function addNote (\AppBundle\Entity\Notes $note)
    {
        if (empty($note->getUser())) {
            $note->setUser($this->getUser());
        }
        $note->addEntity($this);
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \AppBundle\Entity\Notes $note
     */
    public function removeNote (\AppBundle\Entity\Notes $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes ()
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
    public function addText (\AppBundle\Entity\Texts $text)
    {
        if (empty($text->getUser())) {
            $text->setUser($this->getUser());
        }
        $text->addEntity($this);
        $this->texts[] = $text;

        return $this;
    }

    /**
     * Remove text
     *
     * @param \AppBundle\Entity\Texts $text
     */
    public function removeText (\AppBundle\Entity\Texts $text)
    {
        $this->texts->removeElement($text);
    }

    /**
     * Get texts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTexts ()
    {
        return $this->texts;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\Group
     */
    public function getGroup ()
    {
        return $this->group;
    }

    /**
     * Set group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return Entities
     */
    public function setGroup (\AppBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Add uri
     *
     * @param \AppBundle\Entity\Uri $uri
     *
     * @return Entities
     */
    public function addUri (\AppBundle\Entity\Uri $uri)
    {
        if (empty($uri->getUser())) {
            $uri->setUser($this->getUser());
        }
        $uri->setEntity($this);
        $this->uris[] = $uri;

        return $this;
    }

    /**
     * Remove uri
     *
     * @param \AppBundle\Entity\Uri $uri
     */
    public function removeUri (\AppBundle\Entity\Uri $uri)
    {
        $this->uris->removeElement($uri);
    }

    /**
     * Get uris
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUris ()
    {
        return $this->uris;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Entities
     */
    public function addImage (\AppBundle\Entity\Images $image)
    {
        if (empty($image->getUser())) {
            $image->setUser($this->getUser());
        }
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage (\AppBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages ()
    {
        return $this->images;
    }

    public function __toString()
    {
        return "ID ".$this->getId();
    }
}
