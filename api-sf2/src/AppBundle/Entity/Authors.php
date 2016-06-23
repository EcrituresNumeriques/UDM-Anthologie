<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\DependencyInjection\Tests\A;

/**
 * Authors
 *
 * @ORM\Table(name="authors")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
 */
class Authors
{

    use ORMBehaviors\SoftDeletable\SoftDeletable ,
        ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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

    /**
     * @OneToMany(targetEntity="AuthorsTranslations", mappedBy="author")
     */
    private $authorTranslations;

    /**
     * @ManyToOne(targetEntity="Cities")
     * @JoinColumn(name="city_born_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $bornCity;

    /**
     * @ManyToOne(targetEntity="Cities")
     * @JoinColumn(name="city_died_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $diedCity;

    /**
     * @ManyToOne(targetEntity="Eras")
     * @JoinColumn(name="era_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $era;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="authors")
     */
    private $entities;

    /**
     * @ManyToMany(targetEntity="Images")
     * @JoinTable(name="authors_images_assoc",
     *      joinColumns={@JoinColumn(name="author_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->authorTranslations = new ArrayCollection();
        $this->entities           = new ArrayCollection();
        $this->images             = new ArrayCollection();
    }


}

