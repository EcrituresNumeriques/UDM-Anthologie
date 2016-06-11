<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Author
 *
 * @ORM\Table(name="authors")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
 */
class Author
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
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="about", type="string", length=255)
     */
    private $about;

    /**
     * @var int
     *
     * @ORM\Column(name="born", type="integer")
     */
    private $born;

    /**
     * @var int
     *
     * @ORM\Column(name="bornRange", type="smallint")
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
     * @ORM\Column(name="diedRange", type="smallint")
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
     * @ORM\Column(name="activityRange", type="smallint")
     */
    private $activityRange;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColunm(name="city_id, referencedColumnName="id")
     */
    private $bornCity;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColunm(name="city_id, referencedColumnName="id")
     */
    private $diedCity;

    /**
     * @ORM\ManyToOne(targetEntity="Era")
     * @ORM\JoinColunm(name="era_id, referencedColumnName="id")
     */
    private $era;

    /**
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $ownerGroup;
    
    /**
     * @ORM\ManyToMany(targetEntity="Images")
     * @ORM\JoinTable(name="authors_images",
     *      joinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="Entity", inversedBy="entities")
     * @ORM\JoinTable(name="authors_entities")
     */
    private $entities;

    public function __construct() {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }
}