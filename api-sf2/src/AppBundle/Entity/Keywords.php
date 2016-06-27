<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Keywords
 *
 * @ORM\Table(name="keywords")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class Keywords
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
     * @ManyToOne(targetEntity="KeywordsFamilies", inversedBy="keywords")
     * @JoinColumn(name="keyword_family", referencedColumnName="id", onDelete="CASCADE")
     */
    private $keywordFamily;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="keywords")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="keywords")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="KeywordsTranslations", mappedBy="keyword", cascade={"persist"})
     */
    private $keywordsTranslations;

    /**
     * @ManyToMany(targetEntity="KeywordsCategories", inversedBy="keywords", cascade={"persist"})
     * @JoinTable(name="keywords_categories_assoc")
     */
    private $keywordsCategories;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="keywords")
     */
    private $entities;

    /**
     * @ManyToMany(targetEntity="Images")
     * @JoinTable(name="keywords_images_assoc",
     *      joinColumns={@JoinColumn(name="keyword_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->keywordsTranslations = new ArrayCollection();
        $this->keywordsCategories   = new ArrayCollection();
        $this->images               = new ArrayCollection();
        $this->entities             = new ArrayCollection();
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
     * Set keywordFamily
     *
     * @param \AppBundle\Entity\KeywordsFamilies $keywordFamily
     *
     * @return Keywords
     */
    public function setKeywordFamily(\AppBundle\Entity\KeywordsFamilies $keywordFamily = null)
    {
        $this->keywordFamily = $keywordFamily;

        return $this;
    }

    /**
     * Get keywordFamily
     *
     * @return \AppBundle\Entity\KeywordsFamilies
     */
    public function getKeywordFamily()
    {
        return $this->keywordFamily;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Keywords
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
     * @return Keywords
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
     * Add keywordsTranslation
     *
     * @param \AppBundle\Entity\KeywordsTranslations $keywordsTranslation
     *
     * @return Keywords
     */
    public function addKeywordsTranslation(\AppBundle\Entity\KeywordsTranslations $keywordsTranslation)
    {
        $keywordsTranslation->setKeyword($this);
        $this->keywordsTranslations[] = $keywordsTranslation;

        return $this;
    }

    /**
     * Remove keywordsTranslation
     *
     * @param \AppBundle\Entity\KeywordsTranslations $keywordsTranslation
     */
    public function removeKeywordsTranslation(\AppBundle\Entity\KeywordsTranslations $keywordsTranslation)
    {
        $this->keywordsTranslations->removeElement($keywordsTranslation);
    }

    /**
     * Get keywordsTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordsTranslations()
    {
        return $this->keywordsTranslations;
    }

    /**
     * Add keywordsCategory
     *
     * @param \AppBundle\Entity\KeywordsCategories $keywordsCategory
     *
     * @return Keywords
     */
    public function addKeywordsCategory(\AppBundle\Entity\KeywordsCategories $keywordsCategory)
    {
        $this->keywordsCategories[] = $keywordsCategory;

        return $this;
    }

    /**
     * Remove keywordsCategory
     *
     * @param \AppBundle\Entity\KeywordsCategories $keywordsCategory
     */
    public function removeKeywordsCategory(\AppBundle\Entity\KeywordsCategories $keywordsCategory)
    {
        $this->keywordsCategories->removeElement($keywordsCategory);
    }

    /**
     * Get keywordsCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordsCategories()
    {
        return $this->keywordsCategories;
    }

    /**
     * Add entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return Keywords
     */
    public function addEntity(\AppBundle\Entity\Entities $entity)
    {
        $this->entities[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \AppBundle\Entity\Entities $entity
     */
    public function removeEntity(\AppBundle\Entity\Entities $entity)
    {
        $this->entities->removeElement($entity);
    }

    /**
     * Get entities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Images $image
     *
     * @return Keywords
     */
    public function addImage(\AppBundle\Entity\Images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Images $image
     */
    public function removeImage(\AppBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
