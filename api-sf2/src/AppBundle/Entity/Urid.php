<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use AppBundle\Annotation as AppAnnotations;

/**
 * Urid
 *
 * @ORM\Table(name="URId")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Urid
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
     * @ORM\Column(name="value", type="string", length=45, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="UridSources", inversedBy="urid", cascade={"persist"})
     * @JoinColumn(name="urid_source_id", referencedColumnName="id")
     */
    private $uridSources;

    /**
     * @ORM\ManyToOne(targetEntity="Entities", inversedBy="urids")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $entity;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="urids")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="urids")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="UridCategories", mappedBy="urid", cascade={"persist"})
     */
    private $uridsCategories;

    public function __construct ()
    {
        $this->uridsCategories = new ArrayCollection();
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Urid
     */
    public function setEntity(\AppBundle\Entity\Entities $entity = null)
    {
        if (empty($entity->getUser())) {
            $entity->setUser($this->getUser());
        }
        $entity->addUrid($this);
        $this->entity = $entity;

        return $this;
    }

    /**
     * Add uridsCategory
     *
     * @param \AppBundle\Entity\UridCategories $uridsCategory
     *
     * @return Urid
     */
    public function addUridsCategory(\AppBundle\Entity\UridCategories $uridsCategory)
    {
        if (empty($uridsCategory->getUser())) {
            $uridsCategory->setUser($this->getUser());
        }
        $uridsCategory->setUrid($this);
        $this->uridsCategories[] = $uridsCategory;

        return $this;
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
     * Set value
     *
     * @param string $value
     *
     * @return Urid
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set uridSource
     *
     * @param \AppBundle\Entity\UridSources $uridSource
     *
     * @return Urid
     */
    public function setUridSource(\AppBundle\Entity\UridSources $uridSource = null)
    {
        $this->uridSources = $uridSource;

        return $this;
    }

    /**
     * Get uridSource
     *
     * @return \AppBundle\Entity\UridSources
     */
    public function getUridSource()
    {
        return $this->uridSources;
    }

    /**
     * Get entity
     *
     * @return \AppBundle\Entity\Entities
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Urid
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
     * @return Urid
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
     * Remove uridsCategory
     *
     * @param \AppBundle\Entity\UridCategories $uridsCategory
     */
    public function removeUridsCategory(\AppBundle\Entity\UridCategories $uridsCategory)
    {
        $this->uridsCategories->removeElement($uridsCategory);
    }

    /**
     * Get urisCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUridsCategories()
    {
        return $this->uridsCategories;
    }

    /**
     * Set uridSources
     *
     * @param \AppBundle\Entity\UridSources $uridSources
     *
     * @return Urid
     */
    public function setUridSources(\AppBundle\Entity\UridSources $uridSources = null)
    {
        $this->uridSources = $uridSources;

        return $this;
    }

    /**
     * Get uridSources
     *
     * @return \AppBundle\Entity\UridSources
     */
    public function getUridSources()
    {
        return $this->uridSources;
    }
}
