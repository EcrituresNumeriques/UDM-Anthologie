<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsCategories
 *
 * @ORM\Table(name="keywords_categories")
 * @ORM\Entity
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class KeywordsCategories
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
     * @ManyToOne(targetEntity="User", inversedBy="keywordsCategories")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group", inversedBy="keywordsCategories")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;

    /**
     * @OneToMany(targetEntity="KeywordsCategoriesTranslations", mappedBy="keywordCategory", cascade={"persist"})
     */
    private $keywordCategoryTranslations;

    /**
     * @ManyToMany(targetEntity="Keywords", mappedBy="keywordsCategories")
     */
    private $keywords;

    public function __construct ()
    {
        $this->keywords                    = new ArrayCollection();
        $this->keywordCategoryTranslations = new ArrayCollection();
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
     * @return KeywordsCategories
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
     * @return KeywordsCategories
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
     * Add keywordCategoryTranslation
     *
     * @param \AppBundle\Entity\KeywordsCategoriesTranslations $keywordCategoryTranslation
     *
     * @return KeywordsCategories
     */
    public function addKeywordCategoryTranslation(\AppBundle\Entity\KeywordsCategoriesTranslations $keywordCategoryTranslation)
    {
        if (empty($keywordCategoryTranslation->getUser())) {
            $keywordCategoryTranslation->setUser($this->getUser());
        }
        $keywordCategoryTranslation->setKeywordCategory($this);
        $this->keywordCategoryTranslations[] = $keywordCategoryTranslation;

        return $this;
    }

    /**
     * Remove keywordCategoryTranslation
     *
     * @param \AppBundle\Entity\KeywordsCategoriesTranslations $keywordCategoryTranslation
     */
    public function removeKeywordCategoryTranslation(\AppBundle\Entity\KeywordsCategoriesTranslations $keywordCategoryTranslation)
    {
        $this->keywordCategoryTranslations->removeElement($keywordCategoryTranslation);
    }

    /**
     * Get keywordCategoryTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordCategoryTranslations()
    {
        return $this->keywordCategoryTranslations;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     *
     * @return KeywordsCategories
     */
    public function addKeyword(\AppBundle\Entity\Keywords $keyword)
    {
        if (empty($keyword->getUser())) {
            $keyword->setUser($this->getUser());
        }
        $keyword->addKeywordsCategory($this);
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     */
    public function removeKeyword(\AppBundle\Entity\Keywords $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    public function __toString()
    {
        return "Keyword Category ".$this->getId();
    }
}
