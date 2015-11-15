<?php

namespace Basarab\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Handmade", inversedBy="comments")
     */
    public $handmade;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    public $author;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $createdAt;

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
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set handmade
     *
     * @param \Basarab\HandmadeBundle\Entity\Handmade $handmade
     *
     * @return Comment
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

    /**
     * Set author
     *
     * @param \Basarab\HandmadeBundle\Entity\User $author
     *
     * @return Comment
     */
    public function setAuthor(\Basarab\HandmadeBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Basarab\HandmadeBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        return $this->createdAt = new \DateTime();
    }
}
