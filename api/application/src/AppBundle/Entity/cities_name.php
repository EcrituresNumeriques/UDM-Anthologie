<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cities_name
 *
 * @ORM\Table(name="cities_name")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\cities_nameRepository")
 */
class cities_name
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
     * @ORM\Column(name="current_name", type="string", length=255)
     */
    private $currentName;

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
     * @return cities_name
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
     * Set currentName
     *
     * @param string $currentName
     *
     * @return cities_name
     */
    public function setCurrentName($currentName)
    {
        $this->currentName = $currentName;

        return $this;
    }

    /**
     * Get currentName
     *
     * @return string
     */
    public function getCurrentName()
    {
        return $this->currentName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return cities_name
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

