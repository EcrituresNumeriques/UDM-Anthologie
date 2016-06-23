<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BooksTranslation
 *
 * @ORM\Table(name="books_translations")
 * @ORM\Entity
 */
class BooksTranslations
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
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @ManyToOne(targetEntity="Books", inversedBy="bookTranslations")
     * @JoinColumn(name="book_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $book;

    /**
     * @ManyToOne(targetEntity="Languages")
     * @JoinColumn(name="language_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $language;



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
     * Set name
     *
     * @param string $name
     *
     * @return BooksTranslations
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set book
     *
     * @param \AppBundle\Entity\Books $book
     *
     * @return BooksTranslations
     */
    public function setBook(\AppBundle\Entity\Books $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AppBundle\Entity\Books
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set language
     *
     * @param \AppBundle\Entity\Languages $language
     *
     * @return BooksTranslations
     */
    public function setLanguage(\AppBundle\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \AppBundle\Entity\Languages
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
