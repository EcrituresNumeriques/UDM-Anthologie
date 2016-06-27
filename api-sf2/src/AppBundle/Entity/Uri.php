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
 * Uri
 *
 * @ORM\Table(name="URI")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Uri
{
    use ORMBehaviors\SoftDeletable\SoftDeletable ,
        ORMBehaviors\Timestampable\Timestampable;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=45, nullable=true)
     */
    private $value;

    /**
     * @OneToOne(targetEntity="UriSources", inversedBy="uri", cascade={"persist"})
     * @JoinColumn(name="uri_source_id", referencedColumnName="id")
     */
    private $uriSource;

    /**
     * @ORM\ManyToOne(targetEntity="Entities", inversedBy="uris")
     * @ORM\JoinColumn(name="entity_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $entity;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="uris")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="uris")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="UriCategories", mappedBy="uri", cascade={"persist"})
     */
    private $urisCategories;

    public function __construct ()
    {
        $this->urisCategories = new ArrayCollection();
    }



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Uri
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @return Uri
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
     * Set uriSource
     *
     * @param \AppBundle\Entity\UriSources $uriSource
     *
     * @return Uri
     */
    public function setUriSource(\AppBundle\Entity\UriSources $uriSource = null)
    {
        $this->uriSource = $uriSource;

        return $this;
    }

    /**
     * Get uriSource
     *
     * @return \AppBundle\Entity\UriSources
     */
    public function getUriSource()
    {
        return $this->uriSource;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Uri
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
     * @return Uri
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
     * @return Uri
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
     * Add urisCategory
     *
     * @param \AppBundle\Entity\UriCategories $urisCategory
     *
     * @return Uri
     */
    public function addUrisCategory(\AppBundle\Entity\UriCategories $urisCategory)
    {
        $this->urisCategories[] = $urisCategory;

        return $this;
    }

    /**
     * Remove urisCategory
     *
     * @param \AppBundle\Entity\UriCategories $urisCategory
     */
    public function removeUrisCategory(\AppBundle\Entity\UriCategories $urisCategory)
    {
        $this->urisCategories->removeElement($urisCategory);
    }

    /**
     * Get urisCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrisCategories()
    {
        return $this->urisCategories;
    }
}
