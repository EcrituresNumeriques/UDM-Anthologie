<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use JMS\Serializer\Annotation\Exclude;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsTypeTranslation
 *
 * @ORM\Table(name="keywords_categories_translation")
 * @ORM\Entity
 * @AppAnnotations\TranslatableMeta(languageTable="language_id")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class KeywordsCategoriesTranslations
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
     * @ORM\Column(name="label", type="string", length=50, nullable=true)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @ManyToOne(targetEntity="KeywordsCategories", inversedBy="keywordCategoryTranslations")
     * @JoinColumn(name="keyword_category_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    private $keywordCategory;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Group")
     * @JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $group;
    
    /**
     * @ManyToOne(targetEntity="Languages")
     * @JoinColumn(name="language_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $language;



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
     * Set label
     *
     * @param string $label
     *
     * @return KeywordsCategoriesTranslations
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return KeywordsCategoriesTranslations
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set keywordCategory
     *
     * @param \AppBundle\Entity\KeywordsCategories $keywordCategory
     *
     * @return KeywordsCategoriesTranslations
     */
    public function setKeywordCategory(\AppBundle\Entity\KeywordsCategories $keywordCategory = null)
    {
        $this->keywordCategory = $keywordCategory;

        return $this;
    }

    /**
     * Get keywordCategory
     *
     * @return \AppBundle\Entity\KeywordsCategories
     */
    public function getKeywordCategory()
    {
        return $this->keywordCategory;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return KeywordsCategoriesTranslations
     */
    public function setLanguage(\AppBundle\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Languages
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return KeywordsCategoriesTranslations
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
     * @return KeywordsCategoriesTranslations
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
