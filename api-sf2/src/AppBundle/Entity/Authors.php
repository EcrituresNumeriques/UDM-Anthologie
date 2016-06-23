<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Authors
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity
 */
class Authors
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
     * @var integer
     *
     * @ORM\Column(name="born", type="integer", nullable=true)
     */
    private $born;

    /**
     * @var integer
     *
     * @ORM\Column(name="born_range", type="smallint", nullable=true)
     */
    private $bornRange;

    /**
     * @var integer
     *
     * @ORM\Column(name="died", type="integer", nullable=true)
     */
    private $died;

    /**
     * @var integer
     *
     * @ORM\Column(name="died_range", type="smallint", nullable=true)
     */
    private $diedRange;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity", type="smallint", nullable=true)
     */
    private $activity;

    /**
     * @var integer
     *
     * @ORM\Column(name="activity_range", type="smallint", nullable=true)
     */
    private $activityRange;

}

