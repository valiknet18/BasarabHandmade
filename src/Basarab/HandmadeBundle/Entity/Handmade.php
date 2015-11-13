<?php

namespace Basarab\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="handmades")
 */
class Handmade
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="auto")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="handmade")
     */
    public $comments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inverseBy="handmades")
     */
    public $author;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="handmades")
     */
    public $tags;

    /**
     * @OneToMany(targetEntity="File", mappedBy="handmade")
     */
    public $files;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

