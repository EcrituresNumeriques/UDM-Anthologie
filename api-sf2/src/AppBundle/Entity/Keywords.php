<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Keywords
 *
 * @ORM\Table(name="keywords")
 * @ORM\Entity
 */
class Keywords
{
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\KeywordsType")
     * @JoinColumn(name="keywords_type_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $keywordType;


    public function __construct() {
        $this->keywordTranslations = new ArrayCollection();
    }

}

