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
 * Keywords
 *
 * @ORM\Table(name="keywords")
 * @ORM\Entity
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
     * @OneToMany(targetEntity="KeywordsTranslations", mappedBy="keyword")
     */
    private $keywordTranslations;

    /**
     * @ManyToMany(targetEntity="AppBundle\Entity\KeywordsType", inversedBy="keywords")
     * @JoinTable(name="keywords_type_assoc")
     */
    private $keywordsTypes;

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
        $this->keywordTranslations = new ArrayCollection();
        $this->keywordsTypes       = new ArrayCollection();
        $this->images              = new ArrayCollection();
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
     * Add keywordTranslation
     *
     * @param \AppBundle\Entity\KeywordsTranslations $keywordTranslation
     *
     * @return Keywords
     */
    public function addKeywordTranslation(\AppBundle\Entity\KeywordsTranslations $keywordTranslation)
    {
        $this->keywordTranslations[] = $keywordTranslation;

        return $this;
    }

    /**
     * Remove keywordTranslation
     *
     * @param \AppBundle\Entity\KeywordsTranslations $keywordTranslation
     */
    public function removeKeywordTranslation(\AppBundle\Entity\KeywordsTranslations $keywordTranslation)
    {
        $this->keywordTranslations->removeElement($keywordTranslation);
    }

    /**
     * Get keywordTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordTranslations()
    {
        return $this->keywordTranslations;
    }

    /**
     * Add keywordsType
     *
     * @param \AppBundle\Entity\KeywordsType $keywordsType
     *
     * @return Keywords
     */
    public function addKeywordsType(\AppBundle\Entity\KeywordsType $keywordsType)
    {
        $this->keywordsTypes[] = $keywordsType;

        return $this;
    }

    /**
     * Remove keywordsType
     *
     * @param \AppBundle\Entity\KeywordsType $keywordsType
     */
    public function removeKeywordsType(\AppBundle\Entity\KeywordsType $keywordsType)
    {
        $this->keywordsTypes->removeElement($keywordsType);
    }

    /**
     * Get keywordsTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordsTypes()
    {
        return $this->keywordsTypes;
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
}
