<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Entity
 *
 * @ORM\Table(name="entities")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntityTranslationRepository")
 */
class Entity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToMany(targetEntity="EntityTranslation", mappedBy="entities")
     */
    private $translations;

    /**
     * @ORM\ManyToMany(targetEntity="Author", mappedBy="entities")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="City", mappedBy="entities")
     */
    private $cities;

    public function __construct() {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }
}