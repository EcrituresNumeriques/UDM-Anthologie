<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Eras
 *
 * @ORM\Table(name="eras")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EraRepository")
 */
class Eras
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
     * @var integer
     *
     * @ORM\Column(name="date_begin", type="smallint", nullable=true)
     */
    private $dateBegin;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_end", type="smallint", nullable=true)
     */
    private $dateEnd;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="eras")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="eras")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="era")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="Images", mappedBy="era")
     */
    private $images;

    /**
     * @OneToMany(targetEntity="ErasTranslations", mappedBy="era")
     */
    private $eraTranslations;


    public function __construct ()
    {
        $this->entities        = new ArrayCollection();
        $this->eraTranslations = new ArrayCollection();
        $this->images          = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get dateBegin
     *
     * @return integer
     */
    public function getDateBegin ()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateBegin
     *
     * @param integer $dateBegin
     *
     * @return Eras
     */
    public function setDateBegin ($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return integer
     */
    public function getDateEnd ()
    {
        return $this->dateEnd;
    }

    /**
     * Set dateEnd
     *
     * @param integer $dateEnd
     *
     * @return Eras
     */
    public function setDateEnd ($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Add eraTranslation
     *
     * @param \AppBundle\Entity\ErasTranslations $eraTranslation
     *
     * @return Eras
     */
    public function addEraTranslation (\AppBundle\Entity\ErasTranslations $eraTranslation)
    {
        $this->eraTranslations[] = $eraTranslation;

        return $this;
    }

    /**
     * Remove eraTranslation
     *
     * @param \AppBundle\Entity\ErasTranslations $eraTranslation
     */
    public function removeEraTranslation (\AppBundle\Entity\ErasTranslations $eraTranslation)
    {
        $this->eraTranslations->removeElement($eraTranslation);
    }

    /**
     * Get eraTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEraTranslations ()
    {
        return $this->eraTranslations;
    }
}
