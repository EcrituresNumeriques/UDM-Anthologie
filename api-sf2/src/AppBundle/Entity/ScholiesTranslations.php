<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * ScholiesTranslations
 *
 * @ORM\Table(name="scholies_translations")
 * @ORM\Entity
 * @AppAnnotations\TranslatableMeta(languageTable="language_id")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class ScholiesTranslations
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
     * @ORM\Column(name="text_translated", type="text", length=65535, nullable=true)
     */
    private $textTranslated;

    /**
     * @ManyToOne(targetEntity="Scholies", inversedBy="scholieTranslations")
     * @JoinColumn(name="scholie_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $scholie;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", onDelete="SET NULL")
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
     * Set textTranslated
     *
     * @param string $textTranslated
     *
     * @return ScholiesTranslations
     */
    public function setTextTranslated($textTranslated)
    {
        $this->textTranslated = $textTranslated;

        return $this;
    }

    /**
     * Get textTranslated
     *
     * @return string
     */
    public function getTextTranslated()
    {
        return $this->textTranslated;
    }

    /**
     * Set scholie
     *
     * @param \AppBundle\Entity\Scholies $scholie
     *
     * @return ScholiesTranslations
     */
    public function setScholie(\AppBundle\Entity\Scholies $scholie = null)
    {
        $this->scholie = $scholie;

        return $this;
    }

    /**
     * Get scholie
     *
     * @return \AppBundle\Entity\Scholies
     */
    public function getScholie()
    {
        return $this->scholie;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ScholiesTranslations
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
     * @return ScholiesTranslations
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
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return ScholiesTranslations
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
}
