<?php
// src/Acme/ApiBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use FOS\UserBundle\Entity\User as BaseUser;
use JMS\Serializer\Annotation as JMS;

/**
 * User
 *
 * @ORM\Table("fos_users")
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="fos_users_groups",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=45, nullable=true)
     * @JMS\Expose
     */
    private $firstName;
    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=true)
     * @JMS\Expose
     */
    private $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=45, nullable=true)
     * @JMS\Expose
     */
    private $institution;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=45, nullable=true)
     * @JMS\Expose
     */
    private $country;
    /**
     * @OneToMany(targetEntity="Authors", mappedBy="user")
     */
    private $authors;

    /**
     * @OneToMany(targetEntity="Books", mappedBy="user")
     */
    private $books;

    /**
     * @OneToMany(targetEntity="Cities", mappedBy="user")
     */
    private $cities;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="user")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="Eras", mappedBy="user")
     */
    private $eras;

    /**
     * @OneToMany(targetEntity="Genres", mappedBy="user")
     */
    private $genres;

    /**
     * @OneToMany(targetEntity="Images", mappedBy="user")
     */
    private $images;

    /**
     * @OneToMany(targetEntity="Keywords", mappedBy="user")
     */
    private $keywords;

    /**
     * @OneToMany(targetEntity="KeywordsCategories", mappedBy="user")
     */
    private $keywordsCategories;

    /**
     * @OneToMany(targetEntity="Manuscripts", mappedBy="user")
     */
    private $manuscripts;

    /**
     * @OneToMany(targetEntity="Motifs", mappedBy="user")
     */
    private $motifs;

    /**
     * @OneToMany(targetEntity="Notes", mappedBy="user")
     */
    private $notes;

    /**
     * @OneToMany(targetEntity="Scholies", mappedBy="user")
     */
    private $scholies;

    /**
     * @OneToMany(targetEntity="Texts", mappedBy="user")
     */
    private $texts;

    /**
     * @OneToMany(targetEntity="Urid", mappedBy="user")
     */
    private $urids;

    /**
     * @OneToMany(targetEntity="UridCategories", mappedBy="user")
     */
    private $uridsCategories;


    public function __construct ()
    {
        parent::__construct();
        $this->authors            = new ArrayCollection();
        $this->books              = new ArrayCollection();
        $this->cities             = new ArrayCollection();
        $this->entities           = new ArrayCollection();
        $this->eras               = new ArrayCollection();
        $this->genres             = new ArrayCollection();
        $this->images             = new ArrayCollection();
        $this->keywords           = new ArrayCollection();
        $this->keywordsCategories = new ArrayCollection();
        $this->manuscripts        = new ArrayCollection();
        $this->motifs             = new ArrayCollection();
        $this->notes              = new ArrayCollection();
        $this->scholies           = new ArrayCollection();
        $this->texts              = new ArrayCollection();
        $this->urids               = new ArrayCollection();
        $this->uridsCategories     = new ArrayCollection();
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set institution
     *
     * @param string $institution
     *
     * @return User
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Authors $author
     *
     * @return User
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
     * Add book
     *
     * @param \AppBundle\Entity\Books $book
     *
     * @return User
     */
    public function addBook(\AppBundle\Entity\Books $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \AppBundle\Entity\Books $book
     */
    public function removeBook(\AppBundle\Entity\Books $book)
    {
        $this->books->removeElement($book);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Add city
     *
     * @param \AppBundle\Entity\Cities $city
     *
     * @return User
     */
    public function addCity(\AppBundle\Entity\Cities $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \AppBundle\Entity\Cities $city
     */
    public function removeCity(\AppBundle\Entity\Cities $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return User
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \AppBundle\Entity\Entities $entity
     */
    public function removeEntity(\AppBundle\Entity\Entities $entity)
    {
        $this->entities->removeElement($entity);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Add era
     *
     * @param \AppBundle\Entity\Eras $era
     *
     * @return User
     */
    public function addEra(\AppBundle\Entity\Eras $era)
    {
        $this->eras[] = $era;

        return $this;
    }

    /**
     * Remove era
     *
     * @param \AppBundle\Entity\Eras $era
     */
    public function removeEra(\AppBundle\Entity\Eras $era)
    {
        $this->eras->removeElement($era);
    }

    /**
     * Get eras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEras()
    {
        return $this->eras;
    }

    /**
     * Add genre
     *
     * @param \AppBundle\Entity\Genres $genre
     *
     * @return User
     */
    public function addGenre(\AppBundle\Entity\Genres $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre
     *
     * @param \AppBundle\Entity\Genres $genre
     */
    public function removeGenre(\AppBundle\Entity\Genres $genre)
    {
        $this->genres->removeElement($genre);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return User
     */
    public function addImage(\AppBundle\Entity\Images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage(\AppBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     *
     * @return User
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
     * Add keywordsCategory
     *
     * @param \AppBundle\Entity\KeywordsCategories $keywordsCategory
     *
     * @return User
     */
    public function addKeywordsCategory(\AppBundle\Entity\KeywordsCategories $keywordsCategory)
    {
        $this->keywordsCategories[] = $keywordsCategory;

        return $this;
    }

    /**
     * Remove keywordsCategory
     *
     * @param \AppBundle\Entity\KeywordsCategories $keywordsCategory
     */
    public function removeKeywordsCategory(\AppBundle\Entity\KeywordsCategories $keywordsCategory)
    {
        $this->keywordsCategories->removeElement($keywordsCategory);
    }

    /**
     * Get keywordsCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordsCategories()
    {
        return $this->keywordsCategories;
    }

    /**
     * Add manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     *
     * @return User
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
     * Add motif
     *
     * @param \AppBundle\Entity\Motifs $motif
     *
     * @return User
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
     * Add note
     *
     * @param \AppBundle\Entity\Notes $note
     *
     * @return User
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
     * Add scholy
     *
     * @param \AppBundle\Entity\Scholies $scholy
     *
     * @return User
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
     * Add text
     *
     * @param \AppBundle\Entity\Texts $text
     *
     * @return User
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

    /**
     * Add urid
     *
     * @param \AppBundle\Entity\Urid $urid
     *
     * @return User
     */
    public function addUrid(\AppBundle\Entity\Urid $urid)
    {
        $this->urids[] = $urid;

        return $this;
    }

    /**
     * Remove urid
     *
     * @param \AppBundle\Entity\Urid $urid
     */
    public function removeUrid(\AppBundle\Entity\Urid $urid)
    {
        $this->urids->removeElement($urid);
    }

    /**
     * Get urids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrids()
    {
        return $this->urids;
    }

    /**
     * Add uridsCategory
     *
     * @param \AppBundle\Entity\UridCategories $uridsCategory
     *
     * @return User
     */
    public function addUridsCategory(\AppBundle\Entity\UridCategories $urisCategory)
    {
        $this->uridsCategories[] = $urisCategory;

        return $this;
    }

    /**
     * Remove uridsCategory
     *
     * @param \AppBundle\Entity\UridCategories $uridsCategory
     */
    public function removeUridsCategory(\AppBundle\Entity\UridCategories $urisCategory)
    {
        $this->uridsCategories->removeElement($uridsCategory);
    }

    /**
     * Get uridsCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUridsCategories()
    {
        return $this->uridsCategories;
    }
}
