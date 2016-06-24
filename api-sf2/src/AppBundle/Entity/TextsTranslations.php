<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * TextsTranslations
 *
 * @ORM\Table(name="texts_translations")
 * @ORM\Entity
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
     * @ORM\Column(name="text", type="text", length=65535, nullable=true)
     */
    private $textTranslated;

    /**
     * @ManyToOne(targetEntity="Texts", inversedBy="TextsTranslations")
     * @JoinColumn(name="text_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $text;

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
