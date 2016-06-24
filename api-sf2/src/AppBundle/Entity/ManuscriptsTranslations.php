<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * ManuscriptsTranslations
 *
 * @ORM\Table(name="manuscripts_translations")
 * @ORM\Entity
 */
class ManuscriptsTranslations
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @ManyToOne(targetEntity="AppBundle\Entity\Manuscripts", inversedBy="manuscriptTranslations")
     * @JoinColumn(name="manuscript_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $manuscripts;

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
     * @return ManuscriptsTranslations
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
     * Set page
     *
     * @param integer $page
     *
     * @return ManuscriptsTranslations
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set manuscripts
     *
     * @param \AppBundle\Entity\Manuscripts $manuscripts
     *
     * @return ManuscriptsTranslations
     */
    public function setManuscripts(\AppBundle\Entity\Manuscripts $manuscripts = null)
    {
        $this->manuscripts = $manuscripts;

        return $this;
    }

    /**
     * Get manuscripts
     *
     * @return \AppBundle\Entity\Manuscripts
     */
    public function getManuscripts()
    {
        return $this->manuscripts;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return ManuscriptsTranslations
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
