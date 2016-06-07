<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Author
 *
 * @ORM\Table(name="authors")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EraRepository")
 */
class Author
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
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="about", type="string", length=255)
     */
    private $about;

    /**
     * @var int
     *
     * @ORM\Column(name="born", type="integer")
     */
    private $born;

    /**
     * @var int
     *
     * @ORM\Column(name="bornRange", type="smallint")
     */
    private $bornRange;

    /**
     * @var int
     *
     * @ORM\Column(name="died", type="integer")
     */
    private $died;

    /**
     * @var int
     *
     * @ORM\Column(name="diedRange", type="smallint")
     */
    private $diedRange;

    /**
     * @var int
     *
     * @ORM\Column(name="activity", type="integer")
     */
    private $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="activityRange", type="smallint")
     */
    private $activityRange;

    /**
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     */
    private $lang;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     */
    private $ownerGroup;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

}