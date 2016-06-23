<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * EntitiesTranslations
 *
 * @ORM\Table(name="entities_translations")
 * @ORM\Entity
 */
class EntitiesTranslations
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
     * @ORM\Column(name="text_translated", type="string", length=45, nullable=true)
     */
    private $textTranslated;

    /**
     * @ManyToOne(targetEntity="Entities", inversedBy="entityTranslations")
     * @JoinColumn(name="entity_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $entity;

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
     * @return EntitiesTranslations
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
     * Set entity
     *
     * @param \AppBundle\Entity\Entities $entity
     *
     * @return EntitiesTranslations
     */
    public function setEntity(\AppBundle\Entity\Entities $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return \AppBundle\Entity\Entities
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return EntitiesTranslations
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
