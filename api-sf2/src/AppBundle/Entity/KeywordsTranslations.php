<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsTranslation
 *
 * @ORM\Table(name="keywords_translations")
 * @ORM\Entity
 */
class KeywordsTranslations
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
     * @ORM\Column(name="title", type="string", length=45, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @ManyToOne(targetEntity="Keywords", inversedBy="keywordTranslations")
     * @JoinColumn(name="keyword_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $keyword;

    /**
     * @ManyToOne(targetEntity="Languages")
     * @JoinColumn(name="language_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $language;

}

