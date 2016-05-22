<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * eras_name
 *
 * @ORM\Table(name="eras_name")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\eras_nameRepository")
 */
class eras_name
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="culture_centers", type="text")
     */
    private $cultureCenters;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * Get id
     *
     * @return int
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
     * @return eras_name
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
     * @return eras_name
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
     * @return eras_name
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
}

