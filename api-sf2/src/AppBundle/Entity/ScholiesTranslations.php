<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * ScholiesTranslations
 *
 * @ORM\Table(name="scholies_translations")
 * @ORM\Entity
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
