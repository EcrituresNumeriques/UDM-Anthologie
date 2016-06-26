<?php

namespace AppBundle\Entity;

use AppBundle\Annotation as AppAnnotations;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use JMS\Serializer\Annotation\Exclude;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * AuthorTranslation
 *
 * @ORM\Table(name="author_translations")
 * @ORM\Entity
 * @AppAnnotations\TranslatableMeta(languageTable="language_id")
 * @AppAnnotations\UserMeta(userTable="user_id")
 * @AppAnnotations\GroupMeta(groupTable="group_id")
 * @AppAnnotations\SoftDeleteMeta(deleteFlagTable="deleted_at")
 */
class AuthorsTranslations
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", length=65535, nullable=true)
     */
    private $about;

    /**
     * @ManyToOne(targetEntity="Authors", inversedBy="authorTranslations")
     * @JoinColumn(name="author_id", referencedColumnName="id", onDelete="CASCADE")
     * @Exclude
     */
    private $author;

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
     * Set name
     *
     * @param string $name
     *
     * @return AuthorsTranslations
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return AuthorsTranslations
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set author
     *
     * @param \AppBundle\Entity\Authors $author
     *
     * @return AuthorsTranslations
     */
    public function setAuthor(\AppBundle\Entity\Authors $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Entity\Authors
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return AuthorsTranslations
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
     * @return AuthorsTranslations
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
     * @return AuthorsTranslations
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
