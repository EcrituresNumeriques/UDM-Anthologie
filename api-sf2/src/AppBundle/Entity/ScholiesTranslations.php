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
}

