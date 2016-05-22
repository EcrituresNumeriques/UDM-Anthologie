<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * eras
 *
 * @ORM\Table(name="eras")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\erasRepository")
 */
class eras
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
     * @var int
     *
     * @ORM\Column(name="date_begin", type="smallint")
     */
    private $dateBegin;

    /**
     * @var int
     *
     * @ORM\Column(name="date_end", type="smallint")
     */
    private $dateEnd;


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
     * Set dateBegin
     *
     * @param integer $dateBegin
     *
     * @return eras
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return int
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
     * @return eras
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return int
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }
}

