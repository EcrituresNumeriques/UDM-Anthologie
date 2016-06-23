<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Genres
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity
 */
class Genres
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
     * @OneToMany(targetEntity="GenresTranslations", mappedBy="genre")
     */
    private $genreTranslations;


    public function __construct() {
        $this->genreTranslations = new ArrayCollection();
    }

}

