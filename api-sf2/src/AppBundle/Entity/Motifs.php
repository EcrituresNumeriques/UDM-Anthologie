<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use AppBundle\Annotation as AppAnnotations;

/**
 * Motifs
 *
 * @ORM\Table(name="motifs")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Motifs
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
     * @ManyToOne(targetEntity="User", inversedBy="motifs")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="motifs")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="AppBundle\Entity\MotifsTranslations", mappedBy="motif", cascade={"persist"})
     */
    private $motifTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="motifs")
     */
    private $entities;

    public function __construct ()
    {
        $this->motifTranslations = new ArrayCollection();
        $this->entities          = new ArrayCollection();
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
     * Add motifTranslation
     *
     * @param \AppBundle\Entity\MotifsTranslations $motifTranslation
     *
     * @return Motifs
     */
    public function addMotifTranslation(\AppBundle\Entity\MotifsTranslations $motifTranslation)
    {
        if (empty($motifTranslation->getUser())) {
            $motifTranslation->setUser($this->getUser());
        }
        $motifTranslation->setMotif($this);
        $this->motifTranslations[] = $motifTranslation;

        return $this;
    }

    /**
     * Remove motifTranslation
     *
     * @param \AppBundle\Entity\MotifsTranslations $motifTranslation
     */
    public function removeMotifTranslation(\AppBundle\Entity\MotifsTranslations $motifTranslation)
    {
        $this->motifTranslations->removeElement($motifTranslation);
    }

    /**
     * Get motifTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifTranslations()
    {
        return $this->motifTranslations;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Motifs
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
        if (empty($entity->getUser())) {
            $entity->setUser($this->getUser());
        }
        $entity->addMotif($this);
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Motifs
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
     * @return Motifs
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
