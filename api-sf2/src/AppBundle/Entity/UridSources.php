<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use AppBundle\Annotation as AppAnnotations;

/**
 * UriSources
 *
 * @ORM\Table(name="URI_source")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class UridSources
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
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @ORM\OneToMany(targetEntity="Urid", mappedBy="uridSources", cascade={"persist"})
     */
    private $urid;

    public function __construct() {
        $this->urid = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return UridSources
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UridSources
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
     * @return UridSources
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
     * Add urid
     *
     * @param \AppBundle\Entity\Urid $urid
     *
     * @return UridSources
     */
    public function addUrid(\AppBundle\Entity\Urid $urid)
    {
        if (empty($urid->getUser())) {
            $urid->setUser($this->getUser());
        }
        $urid->setUridSource($this);
        $this->urid[] = $urid;

        return $this;
    }

    /**
     * Remove urid
     *
     * @param \AppBundle\Entity\Urid $urid
     */
    public function removeUrid(\AppBundle\Entity\Urid $urid)
    {
        $this->urid->removeElement($urid);
    }

    /**
     * Get urid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrid()
    {
        return $this->urid;
    }
}
