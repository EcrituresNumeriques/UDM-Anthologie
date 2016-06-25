<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use FOS\UserBundle\Model\Group as BaseGroup;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_groups")
 * @JMS\ExclusionPolicy("all")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @JMS\Expose
     */
    protected $name;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $roles;

    /**
     * @OneToMany(targetEntity="Authors", mappedBy="group")
     */
    private $authors;

    /**
     * @OneToMany(targetEntity="Books", mappedBy="group")
     */
    private $books;

    /**
     * @OneToMany(targetEntity="Cities", mappedBy="group")
     */
    private $cities;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="group")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="Eras", mappedBy="group")
     */
    private $eras;

    /**
     * @OneToMany(targetEntity="Genres", mappedBy="group")
     */
    private $genres;

    /**
     * @OneToMany(targetEntity="Images", mappedBy="group")
     */
    private $images;

    /**
     * @OneToMany(targetEntity="Keywords", mappedBy="group")
     */
    private $keywords;

    /**
     * @OneToMany(targetEntity="KeywordsType", mappedBy="group")
     */
    private $keywordsTypes;

    /**
     * @OneToMany(targetEntity="Manuscripts", mappedBy="group")
     */
    private $manuscripts;

    /**
     * @OneToMany(targetEntity="Motifs", mappedBy="group")
     */
    private $motifs;

    /**
     * @OneToMany(targetEntity="Notes", mappedBy="group")
     */
    private $notes;

    /**
     * @OneToMany(targetEntity="Scholies", mappedBy="group")
     */
    private $scholies;

    /**
     * @OneToMany(targetEntity="Texts", mappedBy="group")
     */
    private $texts;

    /**
     * @OneToMany(targetEntity="Uri", mappedBy="group")
     */
    private $uri;

    /**
     * @OneToMany(targetEntity="UriTypes", mappedBy="group")
     */
    private $uriTypes;
    

    public function __construct($name, $roles = array())
    {
        parent::__construct($name, $roles = array());
        $this->name = $name;
        $this->roles = $roles;
        $this->authors       = new ArrayCollection();
        $this->books         = new ArrayCollection();
        $this->cities        = new ArrayCollection();
        $this->entities      = new ArrayCollection();
        $this->eras          = new ArrayCollection();
        $this->genres        = new ArrayCollection();
        $this->images        = new ArrayCollection();
        $this->keywords      = new ArrayCollection();
        $this->keywordsTypes = new ArrayCollection();
        $this->manuscripts   = new ArrayCollection();
        $this->motifs        = new ArrayCollection();
        $this->notes         = new ArrayCollection();
        $this->scholies      = new ArrayCollection();
        $this->texts         = new ArrayCollection();
        $this->uri           = new ArrayCollection();
        $this->uriTypes      = new ArrayCollection();
    }

    /**
     * @param string $role
     *
     * @return Group
     */
    public function addRole($role)
    {
        if (!$this->hasRole($role)) {
            $this->roles[] = strtoupper($role);
        }

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $role
     *
     * @return boolean
     */
    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->roles, true);
    }

    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $role
     *
     * @return Group
     */
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param array $roles
     *
     * @return Group
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\AuthorsTranslations $author
     *
     * @return Group
     */
    public function addAuthor(\AppBundle\Entity\AuthorsTranslations $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\AuthorsTranslations $author
     */
    public function removeAuthor(\AppBundle\Entity\AuthorsTranslations $author)
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * Add keywordsType
     *
     * @param \AppBundle\Entity\KeywordsType $keywordsType
     *
     * @return Group
     */
    public function addKeywordsType(\AppBundle\Entity\KeywordsType $keywordsType)
    {
        $this->keywordsTypes[] = $keywordsType;

        return $this;
    }

    /**
     * Remove keywordsType
     *
     * @param \AppBundle\Entity\KeywordsType $keywordsType
     */
    public function removeKeywordsType(\AppBundle\Entity\KeywordsType $keywordsType)
    {
        $this->keywordsTypes->removeElement($keywordsType);
    }

    /**
     * Get keywordsTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordsTypes()
    {
        return $this->keywordsTypes;
    }

    /**
     * Add manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     *
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * Add uri
     *
     * @param \AppBundle\Entity\Uri $uri
     *
     * @return Group
     */
    public function addUri(\AppBundle\Entity\Uri $uri)
    {
        $this->uri[] = $uri;

        return $this;
    }

    /**
     * Remove uri
     *
     * @param \AppBundle\Entity\Uri $uri
     */
    public function removeUri(\AppBundle\Entity\Uri $uri)
    {
        $this->uri->removeElement($uri);
    }

    /**
     * Get uri
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Add uriType
     *
     * @param \AppBundle\Entity\UriTypes $uriType
     *
     * @return Group
     */
    public function addUriType(\AppBundle\Entity\UriTypes $uriType)
    {
        $this->uriTypes[] = $uriType;

        return $this;
    }

    /**
     * Remove uriType
     *
     * @param \AppBundle\Entity\UriTypes $uriType
     */
    public function removeUriType(\AppBundle\Entity\UriTypes $uriType)
    {
        $this->uriTypes->removeElement($uriType);
    }

    /**
     * Get uriTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUriTypes()
    {
        return $this->uriTypes;
    }
}
