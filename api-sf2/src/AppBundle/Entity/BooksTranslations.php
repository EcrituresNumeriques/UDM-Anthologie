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
    

}

