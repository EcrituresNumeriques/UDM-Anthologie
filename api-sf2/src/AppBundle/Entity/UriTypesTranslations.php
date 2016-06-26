<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UriTypesTranslations
 *
 * @ORM\Table(name="URI_type_translation")
 * @ORM\Entity
 * @AppAnnotations\TranslatableMeta(languageTable="language_id")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
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
    private $uriType;

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
     * Set uriType
     *
     * @param \AppBundle\Entity\UriTypes $uriType
     *
     * @return UriTypesTranslations
     */
    public function setUriType(\AppBundle\Entity\UriTypes $uriType = null)
    {
        $this->uriType = $uriType;

        return $this;
    }

    /**
     * Get uriType
     *
     * @return \AppBundle\Entity\UriTypes
     */
    public function getUriType()
    {
        return $this->uriType;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UriTypesTranslations
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
     * @return UriTypesTranslations
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
