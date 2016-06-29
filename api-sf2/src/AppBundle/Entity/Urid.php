<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

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
     * @ORM\ManyToOne(targetEntity="Entities", inversedBy="urids")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $entity;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="urids")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="urids")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity="UridCategories", inversedBy="urid", cascade={"persist"})
     * @JoinColumn(name="urid_category_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $uridsCategories;

    /**
     * @ORM\ManyToOne(targetEntity="UridSources", inversedBy="urid", cascade={"persist"})
     * @JoinColumn(name="urid_source_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $uridSources;

    
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
     * Set entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Urid
     */
    public function setEntity(\AppBundle\Entity\Entities $entity = null)
    {
        $this->entity = $entity;

        return $this;
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
     * Set uridsCategories
     *
     * @param \AppBundle\Entity\UridCategories $uridsCategories
     *
     * @return Urid
     */
    public function setUridsCategories(\AppBundle\Entity\UridCategories $uridsCategories = null)
    {
        if (empty($uridsCategories->getUser())) {
            $uridsCategories->setUser($this->getUser());
        }
        $this->uridsCategories = $uridsCategories;

        return $this;
    }

    /**
     * Get uridsCategories
     *
     * @return \AppBundle\Entity\UridCategories
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
        if (empty($uridSources->getUser())) {
            $uridSources->setUser($this->getUser());
        }
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
