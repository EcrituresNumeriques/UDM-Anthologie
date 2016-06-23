<?php

namespace AppBundle\Entity;

/**
 * UriTypeTranslation
 */
class UriTypeTranslation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $label;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return UriTypeTranslation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set label
     *
     * @param string $label
     *
     * @return UriTypeTranslation
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}

