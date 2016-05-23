<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\citiesRepository")
 */
class cities
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
     * @ORM\Column(name="GPS", type="string", length=255)
     */
    private $gPS;


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
     * Set gPS
     *
     * @param string $gPS
     *
     * @return cities
     */
    public function setGPS($gPS)
    {
        $this->gPS = $gPS;

        return $this;
    }

    /**
     * Get gPS
     *
     * @return string
     */
    public function getGPS()
    {
        return $this->gPS;
    }
}

