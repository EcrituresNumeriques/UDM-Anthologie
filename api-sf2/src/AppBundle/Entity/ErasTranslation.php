<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * ErasTranslation
 *
 * @ORM\Table(name="eras_translation")
 * @ORM\Entity
 */
class ErasTranslation
{
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
     * Set id
     *
     * @param integer $id
     *
     * @return ErasTranslation
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
     * Set name
     *
     * @param string $name
     *
     * @return ErasTranslation
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
     * @return ErasTranslation
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
     * @return ErasTranslation
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
     * @return ErasTranslation
     */
    public function setEra(Eras $era = null)
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
     * @return ErasTranslation
     */
    public function setLanguage(Languages $language = null)
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
