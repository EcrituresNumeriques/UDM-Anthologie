<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * KeywordsFamilies
 *
 * @ORM\Table(name="keywords_families")
 * @ORM\Entity
 */
class KeywordsFamilies
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false,unique=true)
     */
    private $name;

    /**
     * @OneToMany(targetEntity="AppBundle\Entity\Keywords", mappedBy="keywordFamily")
     */
    private $keywords;
    

    public function __construct() {
        $this->keywords = new ArrayCollection();
    }

}

