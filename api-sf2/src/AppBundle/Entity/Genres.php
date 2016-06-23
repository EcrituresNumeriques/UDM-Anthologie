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
     * Add genreTranslation
     *
     * @param \AppBundle\Entity\GenresTranslations $genreTranslation
     *
     * @return Genres
     */
    public function addGenreTranslation(\AppBundle\Entity\GenresTranslations $genreTranslation)
    {
        $this->genreTranslations[] = $genreTranslation;

        return $this;
    }

    /**
     * Remove genreTranslation
     *
     * @param \AppBundle\Entity\GenresTranslations $genreTranslation
     */
    public function removeGenreTranslation(\AppBundle\Entity\GenresTranslations $genreTranslation)
    {
        $this->genreTranslations->removeElement($genreTranslation);
    }

    /**
     * Get genreTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenreTranslations()
    {
        return $this->genreTranslations;
    }
}
