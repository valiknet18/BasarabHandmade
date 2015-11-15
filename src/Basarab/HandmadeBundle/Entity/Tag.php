<?php

namespace Basarab\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Handmade", inversedBy="tags")
     */
    public $handmades;

    /**
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"name"})
     */
    public $slug;

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
     * Constructor
     */
    public function __construct()
    {
        $this->handmades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tag
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
     * Add handmade
     *
     * @param \Basarab\HandmadeBundle\Entity\Handmade $handmade
     *
     * @return Tag
     */
    public function addHandmade(\Basarab\HandmadeBundle\Entity\Handmade $handmade)
    {
        $this->handmades[] = $handmade;

        return $this;
    }

    /**
     * Remove handmade
     *
     * @param \Basarab\HandmadeBundle\Entity\Handmade $handmade
     */
    public function removeHandmade(\Basarab\HandmadeBundle\Entity\Handmade $handmade)
    {
        $this->handmades->removeElement($handmade);
    }

    /**
     * Get handmades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHandmades()
    {
        return $this->handmades;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
