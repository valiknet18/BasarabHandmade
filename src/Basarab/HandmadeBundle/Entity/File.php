<?php

namespace Basarab\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="files")
 * @ORM\HasLifecycleCallbacks
 */
class File
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Handmade", inversedBy="files")
     */
    public $handmade;

    private $tmp;

    private $file;

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
     * Set path
     *
     * @param string $path
     *
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set handmade
     *
     * @param \Basarab\HandmadeBundle\Entity\Handmade $handmade
     *
     * @return File
     */
    public function setHandmade(\Basarab\HandmadeBundle\Entity\Handmade $handmade = null)
    {
        $this->handmade = $handmade;

        return $this;
    }

    /**
     * Get handmade
     *
     * @return \Basarab\HandmadeBundle\Entity\Handmade
     */
    public function getHandmade()
    {
        return $this->handmade;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/uploads/handmades/';
    }
}
