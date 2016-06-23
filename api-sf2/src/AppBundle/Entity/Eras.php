<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Eras
 *
 * @ORM\Table(name="eras")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EraRepository")
 */
class Eras
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
     * @var integer
     *
     * @ORM\Column(name="date_begin", type="smallint", nullable=true)
     */
    private $dateBegin;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_end", type="smallint", nullable=true)
     */
    private $dateEnd;

    /**
     * @OneToMany(targetEntity="ErasTranslations", mappedBy="era")
     */
    private $eraTranslations;


    public function __construct ()
    {
        $this->eraTranslations = new ArrayCollection();
        $this->authors         = new ArrayCollection();
    }

}
