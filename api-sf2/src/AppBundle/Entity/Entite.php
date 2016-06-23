<?php
/**
 * Created by PhpStorm.
 * User: karael
 * Date: 23/06/2016
 * Time: 14:42
 */

namespace AppBundle\Entity;

/**
 * Lang
 *
 * @ORM\Table(name="entities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntiteRepository")
 */
class Entity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    

}