<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsType
 *
 * @ORM\Table(name="keywords_type")
 * @ORM\Entity
 */
class KeywordsType
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
     * @OneToMany(targetEntity="KeywordsTypeTranslations", mappedBy="keywordType")
     */
    private $keywordTypeTranslations;

    /**
     * @ManyToMany(targetEntity="Keywords", mappedBy="keywordsTypes")
     */
    private $keywords;

    public function __construct ()
    {
        $this->keywords                = new ArrayCollection();
        $this->keywordTypeTranslations = new ArrayCollection();
    }
}

