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
use AppBundle\Annotation as AppAnnotations;

/**
 * Manuscripts
 *
 * @ORM\Table(name="manuscripts")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
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
     * @ManyToOne(targetEntity="User", inversedBy="manuscripts")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="manuscripts")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="ManuscriptsTranslations", mappedBy="manuscript", cascade={"persist"})
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
     * @JoinTable(name="manuscripts_images_assoc",
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
     * Add manuscriptTranslation
     *
     * @param \AppBundle\Entity\ManuscriptsTranslations $manuscriptTranslation
     *
     * @return Manuscripts
     */
    public function addManuscriptTranslation(\AppBundle\Entity\ManuscriptsTranslations $manuscriptTranslation)
    {
        if (empty($manuscriptTranslation->getUser())) {
            $manuscriptTranslation->setUser($this->getUser());
        }
        $manuscriptTranslation->setManuscript($this);
        $this->manuscriptTranslations[] = $manuscriptTranslation;

        return $this;
    }

    /**
     * Remove manuscriptTranslation
     *
     * @param \AppBundle\Entity\ManuscriptsTranslations $manuscriptTranslation
     */
    public function removeManuscriptTranslation(\AppBundle\Entity\ManuscriptsTranslations $manuscriptTranslation)
    {
        $this->manuscriptTranslations->removeElement($manuscriptTranslation);
    }

    /**
     * Get manuscriptTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManuscriptTranslations()
    {
        return $this->manuscriptTranslations;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Manuscripts
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
        if (empty($entity->getUser())) {
            $entity->setUser($this->getUser());
        }
        $entity->addManuscript($this);
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
     * Add scholy
     *
     * @param \AppBundle\Entity\Scholies $scholie
     *
     * @return Manuscripts
     */
    public function addScholie(\AppBundle\Entity\Scholies $scholie)
    {
        if (empty($scholie->getUser())) {
            $scholie->setUser($this->getUser());
        }
        $scholie->addManuscript($this);
        $this->scholies[] = $scholie;

        return $this;
    }

    /**
     * Remove scholie
     *
     * @param \AppBundle\Entity\Scholies $scholie
     */
    public function removeScholie(\AppBundle\Entity\Scholies $scholie)
    {
        $this->scholies->removeElement($scholie);
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
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Manuscripts
     */
    public function addImage(\AppBundle\Entity\Images $image)
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Manuscripts
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
     * @return Manuscripts
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
}
