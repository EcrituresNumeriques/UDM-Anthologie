<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UriTypes
 *
 * @ORM\Table(name="URI_types")
 * @ORM\Entity
 */
class UriTypes
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
     * @ManyToOne(targetEntity="Uri", inversedBy="uriTypes")
     * @JoinColumn(name="uri_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $uri;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="uriTypes")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="uriTypes")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="UriTypesTranslations", mappedBy="uriTypes")
     */
    private $uriTypeTranslations;
    
    public function __construct ()
    {
        $this->uriTypeTranslations = new ArrayCollection();
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
     * Set uri
     *
     * @param \AppBundle\Entity\Uri $uri
     *
     * @return UriTypes
     */
    public function setUri(\AppBundle\Entity\Uri $uri = null)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return \AppBundle\Entity\Uri
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UriTypes
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
     * @return UriTypes
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

    /**
     * Add uriTypeTranslation
     *
     * @param \AppBundle\Entity\uriTypesTranslations $uriTypeTranslation
     *
     * @return UriTypes
     */
    public function addUriTypeTranslation(\AppBundle\Entity\uriTypesTranslations $uriTypeTranslation)
    {
        $this->uriTypeTranslations[] = $uriTypeTranslation;

        return $this;
    }

    /**
     * Remove uriTypeTranslation
     *
     * @param \AppBundle\Entity\uriTypesTranslations $uriTypeTranslation
     */
    public function removeUriTypeTranslation(\AppBundle\Entity\uriTypesTranslations $uriTypeTranslation)
    {
        $this->uriTypeTranslations->removeElement($uriTypeTranslation);
    }

    /**
     * Get uriTypeTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUriTypeTranslations()
    {
        return $this->uriTypeTranslations;
    }
}
