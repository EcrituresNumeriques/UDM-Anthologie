<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * UriSource
 *
 * @ORM\Table(name="URI_source")
 * @ORM\Entity
 */
class UriSource
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
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @OneToOne(targetEntity="Uri", mappedBy="uriSource")
     */
    private $uri;
    
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return UriSource
     */
    public function setName ($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Add uriSource
     *
     * @param \AppBundle\Entity\Uri $uriSource
     *
     * @return UriSource
     */
    public function addUriSource (\AppBundle\Entity\Uri $uriSource)
    {
        $this->uriSource[] = $uriSource;

        return $this;
    }

    /**
     * Remove uriSource
     *
     * @param \AppBundle\Entity\Uri $uriSource
     */
    public function removeUriSource (\AppBundle\Entity\Uri $uriSource)
    {
        $this->uriSource->removeElement($uriSource);
    }

    /**
     * Get uriSource
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUriSource ()
    {
        return $this->uriSource;
    }

    /**
     * Set uri
     *
     * @param \AppBundle\Entity\Uri $uri
     *
     * @return UriSource
     */
    public function setUri(\AppBundle\Entity\Uri $uri = null)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return \AppBundle\Entity\Uri
     */
    public function getUri()
    {
        return $this->uri;
    }
}
