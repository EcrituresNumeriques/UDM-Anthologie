<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * authors
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\authorsRepository")
 */
class authors
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
     * @ORM\Column(name="born", type="integer")
     */
    private $born;

    /**
     * @var int
     *
     * @ORM\Column(name="born_range", type="smallint")
     */
    private $bornRange;

    /**
     * @var int
     *
     * @ORM\Column(name="died", type="integer")
     */
    private $died;

    /**
     * @var int
     *
     * @ORM\Column(name="died_range", type="smallint")
     */
    private $diedRange;

    /**
     * @var int
     *
     * @ORM\Column(name="activity", type="integer")
     */
    private $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="activity_range", type="smallint")
     */
    private $activityRange;


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
     * Set born
     *
     * @param integer $born
     *
     * @return authors
     */
    public function setBorn($born)
    {
        $this->born = $born;

        return $this;
    }

    /**
     * Get born
     *
     * @return int
     */
    public function getBorn()
    {
        return $this->born;
    }

    /**
     * Set bornRange
     *
     * @param integer $bornRange
     *
     * @return authors
     */
    public function setBornRange($bornRange)
    {
        $this->bornRange = $bornRange;

        return $this;
    }

    /**
     * Get bornRange
     *
     * @return int
     */
    public function getBornRange()
    {
        return $this->bornRange;
    }

    /**
     * Set died
     *
     * @param integer $died
     *
     * @return authors
     */
    public function setDied($died)
    {
        $this->died = $died;

        return $this;
    }

    /**
     * Get died
     *
     * @return int
     */
    public function getDied()
    {
        return $this->died;
    }

    /**
     * Set diedRange
     *
     * @param integer $diedRange
     *
     * @return authors
     */
    public function setDiedRange($diedRange)
    {
        $this->diedRange = $diedRange;

        return $this;
    }

    /**
     * Get diedRange
     *
     * @return int
     */
    public function getDiedRange()
    {
        return $this->diedRange;
    }

    /**
     * Set activity
     *
     * @param integer $activity
     *
     * @return authors
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return int
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set activityRange
     *
     * @param integer $activityRange
     *
     * @return authors
     */
    public function setActivityRange($activityRange)
    {
        $this->activityRange = $activityRange;

        return $this;
    }

    /**
     * Get activityRange
     *
     * @return int
     */
    public function getActivityRange()
    {
        return $this->activityRange;
    }
}

