<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Keywords
 *
 * @ORM\Table(name="keywords")
 * @ORM\Entity
 */
class Keywords
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
     * @ManyToOne(targetEntity="KeywordsFamilies", inversedBy="keywords")
     * @JoinColumn(name="keyword_family", referencedColumnName="id", onDelete="CASCADE")
     */
    private $keywordFamily;

    /**
     * @OneToMany(targetEntity="KeywordsTranslations", mappedBy="keyword")
     */
    private $keywordTranslations;

    /**
     * @ManyToMany(targetEntity="AppBundle\Entity\KeywordsType", inversedBy="keywords")
     * @JoinTable(name="keywords_type_assoc")
     */
    private $keywordsTypes;

    /**
     * @ManyToMany(targetEntity="Entities", mappedBy="keywords")
     */
    private $entities;

    /**
     * @ManyToMany(targetEntity="Images")
     * @JoinTable(name="keywords_images",
     *      joinColumns={@JoinColumn(name="keyword_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $images;

    public function __construct ()
    {
        $this->keywordTranslations = new ArrayCollection();
        $this->keywordsTypes       = new ArrayCollection();
        $this->images              = new ArrayCollection();
    }

}

