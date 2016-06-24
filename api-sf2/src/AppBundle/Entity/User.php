<?php
// src/Acme/ApiBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table("fos_users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="fos_users_groups",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @OneToMany(targetEntity="Authors", mappedBy="user")
     */
    private $authors;

    /**
     * @OneToMany(targetEntity="Books", mappedBy="user")
     */
    private $books;

    /**
     * @OneToMany(targetEntity="Cities", mappedBy="user")
     */
    private $cities;

    /**
     * @OneToMany(targetEntity="Entities", mappedBy="user")
     */
    private $entities;

    /**
     * @OneToMany(targetEntity="Eras", mappedBy="user")
     */
    private $eras;

    /**
     * @OneToMany(targetEntity="Genres", mappedBy="user")
     */
    private $genres;

    /**
     * @OneToMany(targetEntity="Images", mappedBy="user")
     */
    private $images;

    /**
     * @OneToMany(targetEntity="Keywords", mappedBy="user")
     */
    private $keywords;

    /**
     * @OneToMany(targetEntity="KeywordsType", mappedBy="user")
     */
    private $keywordsTypes;

    /**
     * @OneToMany(targetEntity="Manuscripts", mappedBy="user")
     */
    private $manuscripts;

    /**
     * @OneToMany(targetEntity="Motifs", mappedBy="user")
     */
    private $motifs;

    /**
     * @OneToMany(targetEntity="Notes", mappedBy="user")
     */
    private $notes;

    /**
     * @OneToMany(targetEntity="Scholies", mappedBy="user")
     */
    private $scholies;

    /**
     * @OneToMany(targetEntity="Texts", mappedBy="user")
     */
    private $texts;

    /**
     * @OneToMany(targetEntity="Uri", mappedBy="user")
     */
    private $uri;

    /**
     * @OneToMany(targetEntity="UriTypes", mappedBy="user")
     */
    private $uriTypes;


    public function __construct ()
    {
        parent::__construct();
        $this->authors       = new ArrayCollection();
        $this->books         = new ArrayCollection();
        $this->cities        = new ArrayCollection();
        $this->entities      = new ArrayCollection();
        $this->eras          = new ArrayCollection();
        $this->genres        = new ArrayCollection();
        $this->images        = new ArrayCollection();
        $this->keywords      = new ArrayCollection();
        $this->keywordsTypes = new ArrayCollection();
        $this->manuscripts   = new ArrayCollection();
        $this->motifs        = new ArrayCollection();
        $this->notes         = new ArrayCollection();
        $this->scholies      = new ArrayCollection();
        $this->texts         = new ArrayCollection();
        $this->uri           = new ArrayCollection();
        $this->uriTypes      = new ArrayCollection();
    }
}
