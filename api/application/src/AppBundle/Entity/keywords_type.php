<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * keywords_type
 *
 * @ORM\Table(name="keywords_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\keywords_typeRepository")
 */
class keywords_type
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

