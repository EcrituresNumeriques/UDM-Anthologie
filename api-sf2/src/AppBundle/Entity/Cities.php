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

/**
 * Cities
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity
 */
class Cities
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
     * @var string
     *
     * @ORM\Column(name="GPS", type="string", length=45, nullable=true)
     */
    private $gps;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="cities")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="cities")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="CitiesTranslations", mappedBy="city")
     */
    private $cityTranslations;

    /**
     * @ManyToMany(targetEntity="Images")
     * @JoinTable(name="cities_images_assoc",
     *      joinColumns={@JoinColumn(name="city_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id")}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->cityTranslations = new ArrayCollection();
        $this->images           = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get gps
     *
     * @return string
     */
    public function getGps ()
    {
        return $this->gps;
    }

    /**
     * Set gps
     *
     * @param string $gps
     *
     * @return Cities
     */
    public function setGps ($gps)
    {
        $this->gps = $gps;

        return $this;
    }

    /**
     * Add cityTranslation
     *
     * @param \AppBundle\Entity\CitiesTranslations $cityTranslation
     *
     * @return Cities
     */
    public function addCityTranslation (\AppBundle\Entity\CitiesTranslations $cityTranslation)
    {
        $this->cityTranslations[] = $cityTranslation;

        return $this;
    }

    /**
     * Remove cityTranslation
     *
     * @param \AppBundle\Entity\CitiesTranslations $cityTranslation
     */
    public function removeCityTranslation (\AppBundle\Entity\CitiesTranslations $cityTranslation)
    {
        $this->cityTranslations->removeElement($cityTranslation);
    }

    /**
     * Get cityTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCityTranslations ()
    {
        return $this->cityTranslations;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Cities
     */
    public function addImage (\AppBundle\Entity\Images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage (\AppBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages ()
    {
        return $this->images;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Cities
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \AppBundle\Entity\Group $group
     *
     * @return Cities
     */
    public function setGroup(\AppBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \AppBundle\Entity\Group
     */
    public function getGroup()
    {
        return $this->group;
    }
}
