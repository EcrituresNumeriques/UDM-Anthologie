<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use JMS\Serializer\Annotation\Exclude;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * TextsTranslations
 *
 * @ORM\Table(name="texts_translations")
 * @ORM\Entity
 * @AppAnnotations\TranslatableMeta(languageTable="language_id")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class TextsTranslations
{
    use ORMBehaviors\SoftDeletable\SoftDeletable,
        ORMBehaviors\Timestampable\Timestampable
    ;
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
     * @ORM\Column(name="editor", type="string", length=45, nullable=true)
     */
    private $editor;

    /**
     * @var string
     *
     * @ORM\Column(name="sound_url", type="string", length=255, nullable=true)
     */
    private $soundUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535)
     */
    private $textTranslated;

    /**
     * @ManyToOne(targetEntity="Texts", inversedBy="textTranslations")
     * @JoinColumn(name="text_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    private $text;

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
     * Set editor
     *
     * @param string $editor
     *
     * @return TextsTranslations
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set soundUrl
     *
     * @param string $soundUrl
     *
     * @return TextsTranslations
     */
    public function setSoundUrl($soundUrl)
    {
        $this->soundUrl = $soundUrl;

        return $this;
    }

    /**
     * Get soundUrl
     *
     * @return string
     */
    public function getSoundUrl()
    {
        return $this->soundUrl;
    }

    /**
     * Set textTranslated
     *
     * @param string $textTranslated
     *
     * @return TextsTranslations
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
     * Set text
     *
     * @param \AppBundle\Entity\Texts $text
     *
     * @return TextsTranslations
     */
    public function setText(\AppBundle\Entity\Texts $text = null)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return \AppBundle\Entity\Texts
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return TextsTranslations
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
     * @return TextsTranslations
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
     * @return TextsTranslations
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
