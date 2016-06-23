<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsType
 *
 * @ORM\Table(name="keywords_type")
 * @ORM\Entity
 */
class KeywordsType
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
     * @OneToMany(targetEntity="KeywordsTypeTranslations", mappedBy="keywordType")
     */
    private $keywordTypeTranslations;

    /**
     * @ManyToMany(targetEntity="Keywords", mappedBy="keywordsTypes")
     */
    private $keywords;

    public function __construct ()
    {
        $this->keywords                = new ArrayCollection();
        $this->keywordTypeTranslations = new ArrayCollection();
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
     * Add keywordTypeTranslation
     *
     * @param \AppBundle\Entity\KeywordsTypeTranslations $keywordTypeTranslation
     *
     * @return KeywordsType
     */
    public function addKeywordTypeTranslation(\AppBundle\Entity\KeywordsTypeTranslations $keywordTypeTranslation)
    {
        $this->keywordTypeTranslations[] = $keywordTypeTranslation;

        return $this;
    }

    /**
     * Remove keywordTypeTranslation
     *
     * @param \AppBundle\Entity\KeywordsTypeTranslations $keywordTypeTranslation
     */
    public function removeKeywordTypeTranslation(\AppBundle\Entity\KeywordsTypeTranslations $keywordTypeTranslation)
    {
        $this->keywordTypeTranslations->removeElement($keywordTypeTranslation);
    }

    /**
     * Get keywordTypeTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywordTypeTranslations()
    {
        return $this->keywordTypeTranslations;
    }

    /**
     * Add keyword
     *
     * @param \AppBundle\Entity\Keywords $keyword
     *
     * @return KeywordsType
     */
    public function addKeyword(\AppBundle\Entity\Keywords $keyword)
    {
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
}
