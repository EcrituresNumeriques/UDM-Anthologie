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
 * Scholies
 *
 * @ORM\Table(name="scholies")
 * @ORM\Entity
 */
class Scholies
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
     * @ManyToOne(targetEntity="User", inversedBy="scholies")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="scholies")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;


    /**
     * @OneToMany(targetEntity="AppBundle\Entity\NotesTranslations", mappedBy="scholie")
     */
    private $scholieTranslations;

    /**
     * @ManyToMany(targetEntity="Manuscripts", mappedBy="scholies")
     */
    private $manuscripts;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="scholies")
     */
    private $entities;

    public function __construct ()
    {
        $this->scholieTranslations = new ArrayCollection();
        $this->manuscripts         = new ArrayCollection();
        $this->entities            = new ArrayCollection();
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
     * Add scholieTranslation
     *
     * @param \AppBundle\Entity\NotesTranslations $scholieTranslation
     *
     * @return Scholies
     */
    public function addScholieTranslation(\AppBundle\Entity\NotesTranslations $scholieTranslation)
    {
        $this->scholieTranslations[] = $scholieTranslation;

        return $this;
    }

    /**
     * Remove scholieTranslation
     *
     * @param \AppBundle\Entity\NotesTranslations $scholieTranslation
     */
    public function removeScholieTranslation(\AppBundle\Entity\NotesTranslations $scholieTranslation)
    {
        $this->scholieTranslations->removeElement($scholieTranslation);
    }

    /**
     * Get scholieTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScholieTranslations()
    {
        return $this->scholieTranslations;
    }

    /**
     * Add manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     *
     * @return Scholies
     */
    public function addManuscript(\AppBundle\Entity\Manuscripts $manuscript)
    {
        $this->manuscripts[] = $manuscript;

        return $this;
    }

    /**
     * Remove manuscript
     *
     * @param \AppBundle\Entity\Manuscripts $manuscript
     */
    public function removeManuscript(\AppBundle\Entity\Manuscripts $manuscript)
    {
        $this->manuscripts->removeElement($manuscript);
    }

    /**
     * Get manuscripts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManuscripts()
    {
        return $this->manuscripts;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Scholies
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
}
