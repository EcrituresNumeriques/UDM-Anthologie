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
 * Authors
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Authors
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
     * @var integer
     *
     * @ORM\Column(name="born", type="integer", nullable=true)
     */
    private $born;

    /**
     * @var integer
     *
     * @ORM\Column(name="born_range", type="smallint", nullable=true)
     */
    private $bornRange;

    /**
     * @var integer
     *
     * @ORM\Column(name="died", type="integer", nullable=true)
     */
    private $died;

    /**
     * @var integer
     *
     * @ORM\Column(name="died_range", type="smallint", nullable=true)
     */
    private $diedRange;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity", type="smallint", nullable=true)
     */
    private $activity;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity_range", type="smallint", nullable=true)
     */
    private $activityRange;

    /**
     * @ManyToOne(targetEntity="Cities", cascade={"persist"})
     * @JoinColumn(name="city_born_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $bornCity;

    /**
     * @ManyToOne(targetEntity="Cities", cascade={"persist"})
     * @JoinColumn(name="city_died_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $diedCity;

    /**
     * @ManyToOne(targetEntity="Eras", cascade={"persist"})
     * @JoinColumn(name="era_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $era;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="authors")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="authors")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="AuthorsTranslations", mappedBy="author", cascade={"persist"})
     */
    private $authorTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="authors")
     */
    private $entities;

    /**
     * @ManyToMany(targetEntity="Images", cascade={"persist"})
     * @JoinTable(name="authors_images_assoc",
     *      joinColumns={@JoinColumn(name="author_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->authorTranslations = new ArrayCollection();
        $this->entities           = new ArrayCollection();
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
     * Get born
     *
     * @return integer
     */
    public function getBorn ()
    {
        return $this->born;
    }

    /**
     * Set born
     *
     * @param integer $born
     *
     * @return Authors
     */
    public function setBorn ($born)
    {
        $this->born = $born;

        return $this;
    }

    /**
     * Get bornRange
     *
     * @return integer
     */
    public function getBornRange ()
    {
        return $this->bornRange;
    }

    /**
     * Set bornRange
     *
     * @param integer $bornRange
     *
     * @return Authors
     */
    public function setBornRange ($bornRange)
    {
        $this->bornRange = $bornRange;

        return $this;
    }

    /**
     * Get died
     *
     * @return integer
     */
    public function getDied ()
    {
        return $this->died;
    }

    /**
     * Set died
     *
     * @param integer $died
     *
     * @return Authors
     */
    public function setDied ($died)
    {
        $this->died = $died;

        return $this;
    }

    /**
     * Get diedRange
     *
     * @return integer
     */
    public function getDiedRange ()
    {
        return $this->diedRange;
    }

    /**
     * Set diedRange
     *
     * @param integer $diedRange
     *
     * @return Authors
     */
    public function setDiedRange ($diedRange)
    {
        $this->diedRange = $diedRange;

        return $this;
    }

    /**
     * Get activity
     *
     * @return integer
     */
    public function getActivity ()
    {
        return $this->activity;
    }

    /**
     * Set activity
     *
     * @param integer $activity
     *
     * @return Authors
     */
    public function setActivity ($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activityRange
     *
     * @return integer
     */
    public function getActivityRange ()
    {
        return $this->activityRange;
    }

    /**
     * Set activityRange
     *
     * @param integer $activityRange
     *
     * @return Authors
     */
    public function setActivityRange ($activityRange)
    {
        $this->activityRange = $activityRange;

        return $this;
    }

    /**
     * Add authorTranslation
     *
     * @param \AppBundle\Entity\AuthorsTranslations $authorTranslation
     *
     * @return Authors
     */
    public function addAuthorTranslation (\AppBundle\Entity\AuthorsTranslations $authorTranslation)
    {
        $authorTranslation->setAuthor($this);
        $this->authorTranslations[] = $authorTranslation;

        return $this;
    }

    /**
     * Remove authorTranslation
     *
     * @param \AppBundle\Entity\AuthorsTranslations $authorTranslation
     */
    public function removeAuthorTranslation (\AppBundle\Entity\AuthorsTranslations $authorTranslation)
    {
        $this->authorTranslations->removeElement($authorTranslation);
    }

    /**
     * Get authorTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthorTranslations ()
    {
        return $this->authorTranslations;
    }

    /**
     * Get bornCity
     *
     * @return \AppBundle\Entity\Cities
     */
    public function getBornCity ()
    {
        return $this->bornCity;
    }

    /**
     * Set bornCity
     *
     * @param \AppBundle\Entity\Cities $bornCity
     *
     * @return Authors
     */
    public function setBornCity (\AppBundle\Entity\Cities $bornCity = null)
    {
        $this->bornCity = $bornCity;

        return $this;
    }

    /**
     * Get diedCity
     *
     * @return \AppBundle\Entity\Cities
     */
    public function getDiedCity ()
    {
        return $this->diedCity;
    }

    /**
     * Set diedCity
     *
     * @param \AppBundle\Entity\Cities $diedCity
     *
     * @return Authors
     */
    public function setDiedCity (\AppBundle\Entity\Cities $diedCity = null)
    {
        $this->diedCity = $diedCity;

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
     * @return Authors
     */
    public function setEra (\AppBundle\Entity\Eras $era = null)
    {
        $this->era = $era;

        return $this;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Authors
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

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Authors
     */
    public function addImage (\AppBundle\Entity\Images $image)
    {
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
     * @return Authors
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
     * @return Authors
     */
    public function setGroup (\AppBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }
}
