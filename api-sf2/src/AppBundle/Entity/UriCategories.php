<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use AppBundle\Annotation as AppAnnotations;

/**
 * UriCategories
 *
 * @ORM\Table(name="URI_types")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class UriCategories
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
     * @ManyToOne(targetEntity="Uri", inversedBy="urisCategories")
     * @JoinColumn(name="uri_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $uri;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="urisCategories")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="urisCategories")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="UriCategoriesTranslations", mappedBy="uriCategory", cascade={"persist"})
     */
    private $uriCategoryTranslations;
    
    public function __construct ()
    {
        $this->uriCategoryTranslations = new ArrayCollection();
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
     * Set uri
     *
     * @param \AppBundle\Entity\Uri $uri
     *
     * @return UriCategories
     */
    public function setUri(\AppBundle\Entity\Uri $uri = null)
    {
        if (empty($uri->getUser())) {
            $uri->setUser($this->getUser());
        }
        $uri->addUrisCategory($this);
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
     * @return UriCategories
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
     * @return UriCategories
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
     * Add uriCategoryTranslation
     *
     * @param \AppBundle\Entity\UriCategoriesTranslations $uriCategoryTranslation
     *
     * @return UriCategories
     */
    public function addUriCategoryTranslation(\AppBundle\Entity\UriCategoriesTranslations $uriCategoryTranslation)
    {
        if (empty($uriCategoryTranslation->getUser())) {
            $uriCategoryTranslation->setUser($this->getUser());
        }
        $uriCategoryTranslation->setUriCategory($this);
        $this->uriCategoryTranslations[] = $uriCategoryTranslation;

        return $this;
    }

    /**
     * Remove uriCategoryTranslation
     *
     * @param \AppBundle\Entity\UriCategoriesTranslations $uriCategoryTranslation
     */
    public function removeUriCategoryTranslation(\AppBundle\Entity\UriCategoriesTranslations $uriCategoryTranslation)
    {
        $this->uriCategoryTranslations->removeElement($uriCategoryTranslation);
    }

    /**
     * Get uriCategoryTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUriCategoryTranslations()
    {
        return $this->uriCategoryTranslations;
    }
}
