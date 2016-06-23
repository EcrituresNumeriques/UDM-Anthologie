<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity
 */
class Books
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
     * @OneToMany(targetEntity="BooksTranslations", mappedBy="book")
     */
    private $bookTranslations;


    public function __construct ()
    {
        $this->bookTranslations = new ArrayCollection();
    }


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
     * Add bookTranslation
     *
     * @param \AppBundle\Entity\BooksTranslations $bookTranslation
     *
     * @return Books
     */
    public function addBookTranslation(\AppBundle\Entity\BooksTranslations $bookTranslation)
    {
        $this->bookTranslations[] = $bookTranslation;

        return $this;
    }

    /**
     * Remove bookTranslation
     *
     * @param \AppBundle\Entity\BooksTranslations $bookTranslation
     */
    public function removeBookTranslation(\AppBundle\Entity\BooksTranslations $bookTranslation)
    {
        $this->bookTranslations->removeElement($bookTranslation);
    }

    /**
     * Get bookTranslations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookTranslations()
    {
        return $this->bookTranslations;
    }
}
