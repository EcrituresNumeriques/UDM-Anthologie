<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * ErasTranslation
 *
 * @ORM\Table(name="eras_translations")
 * @ORM\Entity
 */
class ErasTranslations
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="culture_centers", type="text", length=65535, nullable=true)
     */
    private $cultureCenters;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @ManyToOne(targetEntity="Eras", inversedBy="eraTranslations")
     * @JoinColumn(name="era_id", referencedColumnName="id")
     */
    private $era;

    /**
     * @ManyToOne(targetEntity="Languages")
     * @JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;


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
     * @return ErasTranslations
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
     * Set cultureCenters
     *
     * @param string $cultureCenters
     *
     * @return ErasTranslations
     */
    public function setCultureCenters($cultureCenters)
    {
        $this->cultureCenters = $cultureCenters;

        return $this;
    }

    /**
     * Get cultureCenters
     *
     * @return string
     */
    public function getCultureCenters()
    {
        return $this->cultureCenters;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ErasTranslations
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set era
     *
     * @param \AppBundle\Entity\Eras $era
     *
     * @return ErasTranslations
     */
    public function setEra(\AppBundle\Entity\Eras $era = null)
    {
        $this->era = $era;

        return $this;
    }

    /**
     * Get era
     *
     * @return \AppBundle\Entity\Eras
     */
    public function getEra()
    {
        return $this->era;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return ErasTranslations
     */
    public function setLanguage(\AppBundle\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Languages
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
