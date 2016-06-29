<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use AppBundle\Annotation as AppAnnotations;

/**
 * Genres
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Genres
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
     * @ManyToOne(targetEntity="User", inversedBy="genres")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="genres")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="genre")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="GenresTranslations", mappedBy="genre", cascade={"persist"})
     */
    private $genreTranslations;


    public function __construct ()
    {
        $this->entities          = new ArrayCollection();
        $this->genreTranslations = new ArrayCollection();
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
     * Add genreTranslation
     *
     * @param \AppBundle\Entity\GenresTranslations $genreTranslation
     *
     * @return Genres
     */
    public function addGenreTranslation (\AppBundle\Entity\GenresTranslations $genreTranslation)
    {
        if (empty($genreTranslation->getUser())) {
            $genreTranslation->setUser($this->getUser());
        }
        $genreTranslation->setGenre($this);
        $this->genreTranslations[] = $genreTranslation;

        return $this;
    }

    /**
     * Remove genreTranslation
     *
     * @param \AppBundle\Entity\GenresTranslations $genreTranslation
     */
    public function removeGenreTranslation (\AppBundle\Entity\GenresTranslations $genreTranslation)
    {
        $this->genreTranslations->removeElement($genreTranslation);
    }

    /**
     * Get genreTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenreTranslations ()
    {
        return $this->genreTranslations;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Genres
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return Genres
     */
    public function setGroup(\AppBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Genres
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
        if (empty($entity->getUser())) {
            $entity->setUser($this->getUser());
        }
        $entity->setGenre($this);
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

    public function __toString()
    {
        return "Genre ".$this->getId();
    }

}
