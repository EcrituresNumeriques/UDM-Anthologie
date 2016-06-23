<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Eras
 *
 * @ORM\Table(name="eras")
 * @ORM\Entity
 */
class Eras
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @OneToMany(targetEntity="ErasTranslation", mappedBy="era")
     */
    private $eraTranslations;


    public function __construct() {
        $this->features = new ArrayCollection();
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
     * Set dateBegin
     *
     * @param integer $dateBegin
     *
     * @return Eras
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return integer
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param integer $dateEnd
     *
     * @return Eras
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return integer
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add eraTranslation
     *
     * @param \AppBundle\Entity\ErasTranslation $eraTranslation
     *
     * @return Eras
     */
    public function addEraTranslation(\AppBundle\Entity\ErasTranslation $eraTranslation)
    {
        $this->eraTranslations[] = $eraTranslation;

        return $this;
    }

    /**
     * Remove eraTranslation
     *
     * @param \AppBundle\Entity\ErasTranslation $eraTranslation
     */
    public function removeEraTranslation(\AppBundle\Entity\ErasTranslation $eraTranslation)
    {
        $this->eraTranslations->removeElement($eraTranslation);
    }

    /**
     * Get eraTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEraTranslations()
    {
        return $this->eraTranslations;
    }
}
