<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * entities
 *
 * @ORM\Table(name="entities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\entitiesRepository")
 */
class entities
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="date", type="smallint")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="date_range", type="smallint")
     */
    private $dateRange;


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
     * Set title
     *
     * @param string $title
     *
     * @return entities
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param integer $date
     *
     * @return entities
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateRange
     *
     * @param integer $dateRange
     *
     * @return entities
     */
    public function setDateRange($dateRange)
    {
        $this->dateRange = $dateRange;

        return $this;
    }

    /**
     * Get dateRange
     *
     * @return int
     */
    public function getDateRange()
    {
        return $this->dateRange;
    }
}

