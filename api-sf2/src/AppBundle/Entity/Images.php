<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity
 */
class Images
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
     * @var integer
     *
     * @ORM\Column(name="date", type="smallint", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_range", type="smallint", nullable=true)
     */
    private $dateRange;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=45, nullable=true)
     */
    private $author;

    /**
     * @ManyToOne(targetEntity="Eras")
     * @JoinColumn(name="era_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $era;



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
     * Set date
     *
     * @param integer $date
     *
     * @return Images
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateRange
     *
     * @param integer $dateRange
     *
     * @return Images
     */
    public function setDateRange($dateRange)
    {
        $this->dateRange = $dateRange;

        return $this;
    }

    /**
     * Get dateRange
     *
     * @return integer
     */
    public function getDateRange()
    {
        return $this->dateRange;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Images
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Images
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set era
     *
     * @param \AppBundle\Entity\Eras $era
     *
     * @return Images
     */
    public function setEra(\AppBundle\Entity\Eras $era = null)
    {
        $this->era = $era;

        return $this;
    }

    /**
     * Get era
     *
     * @return \AppBundle\Entity\Eras
     */
    public function getEra()
    {
        return $this->era;
    }
}
