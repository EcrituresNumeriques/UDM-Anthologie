<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Motifs
 *
 * @ORM\Table(name="motifs")
 * @ORM\Entity
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
     * @OneToMany(targetEntity="AppBundle\Entity\MotifsTranslations", mappedBy="motif")
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
