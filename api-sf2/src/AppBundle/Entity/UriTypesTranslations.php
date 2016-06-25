<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UriTypesTranslations
 *
 * @ORM\Table(name="URI_type_translation")
 * @ORM\Entity
 */
class UriTypesTranslations
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
     * @ORM\Column(name="label", type="string", length=45, nullable=true)
     */
    private $label;

    /**
     * @ManyToOne(targetEntity="UriTypes", inversedBy="uriTypeTranslations")
     * @JoinColumn(name="uri_type_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $uriTypes;

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
     * @return UriTypesTranslations
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
     * Set uriTypes
     *
     * @param \AppBundle\Entity\UriTypes $uriTypes
     *
     * @return UriTypesTranslations
     */
    public function setUriTypes(\AppBundle\Entity\UriTypes $uriTypes = null)
    {
        $this->uriTypes = $uriTypes;

        return $this;
    }

    /**
     * Get uriTypes
     *
     * @return \AppBundle\Entity\UriTypes
     */
    public function getUriTypes()
    {
        return $this->uriTypes;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return UriTypesTranslations
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
