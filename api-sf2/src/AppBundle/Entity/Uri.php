<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Uri
 *
 * @ORM\Table(name="URI")
 * @ORM\Entity
 */
class Uri
{
    use ORMBehaviors\SoftDeletable\SoftDeletable,
        ORMBehaviors\Timestampable\Timestampable
    ;
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
     * @ManyToOne(targetEntity="UriSource", inversedBy="uris")
     * @JoinColumn(name="entity_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $uriSource;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="uris")
     * @JoinColumn(name="entity_id", referencedColumnName="id", onDelete="SET NULL")
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
     * @param \AppBundle\Entity\UriSource $uriSource
     *
     * @return Uri
     */
    public function setUriSource(\AppBundle\Entity\UriSource $uriSource = null)
    {
        $this->uriSource = $uriSource;

        return $this;
    }

    /**
     * Get uriSource
     *
     * @return \AppBundle\Entity\UriSource
     */
    public function getUriSource()
    {
        return $this->uriSource;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Group $entity
     *
     * @return Uri
     */
    public function setEntity(\AppBundle\Entity\Group $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return \AppBundle\Entity\Group
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
}
