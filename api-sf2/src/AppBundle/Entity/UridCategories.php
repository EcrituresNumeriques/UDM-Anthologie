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
 * UridCategories
 *
 * @ORM\Table(name="URId_categories")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class UridCategories
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
     * @ManyToOne(targetEntity="User", inversedBy="uridsCategories")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="uridsCategories")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="UridCategoriesTranslations", mappedBy="uridCategory", cascade={"persist"})
     */
    private $uridCategoryTranslations;

    /**
     * @OneToMany(targetEntity="Urid", mappedBy="uridsCategories", cascade={"persist"})
     */
    private $urid;

    public function __construct ()
    {
        $this->urid = new ArrayCollection();
        $this->uridCategoryTranslations = new ArrayCollection();
    }


    /**
     * Add uridCategoryTranslation
     *
     * @param \AppBundle\Entity\UridCategoriesTranslations $uridCategoryTranslation
     *
     * @return UridCategories
     */
    public function addUridCategoryTranslation(\AppBundle\Entity\UridCategoriesTranslations $uridCategoryTranslation)
    {
        if (empty($uridCategoryTranslation->getUser())) {
            $uridCategoryTranslation->setUser($this->getUser());
        }
        $uridCategoryTranslation->setUridCategory($this);
        $this->uridCategoryTranslations[] = $uridCategoryTranslation;

        return $this;
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UridCategories
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
     * @return UridCategories
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
     * Remove uridCategoryTranslation
     *
     * @param \AppBundle\Entity\UridCategoriesTranslations $uridCategoryTranslation
     */
    public function removeUridCategoryTranslation(\AppBundle\Entity\UridCategoriesTranslations $uridCategoryTranslation)
    {
        $this->uridCategoryTranslations->removeElement($uridCategoryTranslation);
    }

    /**
     * Get uridCategoryTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUridCategoryTranslations()
    {
        return $this->uridCategoryTranslations;
    }

    /**
     * Add urid
     *
     * @param \AppBundle\Entity\Urid $urid
     *
     * @return UridCategories
     */
    public function addUrid(\AppBundle\Entity\Urid $urid)
    {
        $this->urid[] = $urid;

        return $this;
    }

    /**
     * Remove urid
     *
     * @param \AppBundle\Entity\Urid $urid
     */
    public function removeUrid(\AppBundle\Entity\Urid $urid)
    {
        $this->urid->removeElement($urid);
    }

    /**
     * Get urid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrid()
    {
        return $this->urid;
    }
}
