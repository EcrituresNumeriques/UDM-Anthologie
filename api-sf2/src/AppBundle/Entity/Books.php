<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Books
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
     * @ManyToOne(targetEntity="User", inversedBy="books")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="books")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="book")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="BooksTranslations", mappedBy="book", cascade={"persist"})
     */
    private $bookTranslations;


    public function __construct ()
    {
        $this->bookTranslations = new ArrayCollection();
        $this->entities         = new ArrayCollection();
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
     * Add bookTranslation
     *
     * @param \AppBundle\Entity\BooksTranslations $bookTranslation
     *
     * @return Books
     */
    public function addBookTranslation (\AppBundle\Entity\BooksTranslations $bookTranslation)
    {
        $bookTranslation->setBook($this);
        $this->bookTranslations[] = $bookTranslation;

        return $this;
    }

    /**
     * Remove bookTranslation
     *
     * @param \AppBundle\Entity\BooksTranslations $bookTranslation
     */
    public function removeBookTranslation (\AppBundle\Entity\BooksTranslations $bookTranslation)
    {
        $this->bookTranslations->removeElement($bookTranslation);
    }

    /**
     * Get bookTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookTranslations ()
    {
        return $this->bookTranslations;
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
     * @return Books
     */
    public function setUser (\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
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
     * @return Books
     */
    public function setGroup (\AppBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Books
     */
    public function addEntity (\AppBundle\Entity\Entities $entity)
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \AppBundle\Entity\Entities $entity
     */
    public function removeEntity (\AppBundle\Entity\Entities $entity)
    {
        $this->entities->removeElement($entity);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntities ()
    {
        return $this->entities;
    }
}
