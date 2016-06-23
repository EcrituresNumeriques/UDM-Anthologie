<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity
 */
class Cities
{
    use ORMBehaviors\SoftDeletable\SoftDeletable,
        ORMBehaviors\Timestampable\Timestampable
    ;

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
     * @ORM\Column(name="GPS", type="string", length=45, nullable=true)
     */
    private $gps;

    /**
     * @OneToMany(targetEntity="CitiesTranslations", mappedBy="city")
     */
    private $cityTranslations;

    public function __construct() {
        $this->cityTranslations = new ArrayCollection();
    }
}

