<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Texts
 *
 * @ORM\Table(name="texts")
 * @ORM\Entity
 */
class Texts
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
     * @ManyToOne(targetEntity="User", inversedBy="texts")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="texts")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;


    /**
     * @OneToMany(targetEntity="TextsTranslations", mappedBy="text")
     */
    private $textTranslations;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="texts")
     */
    private $entities;

    public function __construct ()
    {
        $this->textTranslations = new ArrayCollection();
        $this->entities         = new ArrayCollection();
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
     * Add textTranslation
     *
     * @param \AppBundle\Entity\NotesTranslations $textTranslation
     *
     * @return Texts
     */
    public function addTextTranslation(\AppBundle\Entity\NotesTranslations $textTranslation)
    {
        $this->textTranslations[] = $textTranslation;

        return $this;
    }

    /**
     * Remove textTranslation
     *
     * @param \AppBundle\Entity\NotesTranslations $textTranslation
     */
    public function removeTextTranslation(\AppBundle\Entity\NotesTranslations $textTranslation)
    {
        $this->textTranslations->removeElement($textTranslation);
    }

    /**
     * Get textTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextTranslations()
    {
        return $this->textTranslations;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Texts
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
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
     * @return Texts
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
     * @return Texts
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
