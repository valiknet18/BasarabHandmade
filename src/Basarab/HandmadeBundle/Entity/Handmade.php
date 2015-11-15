<?php

namespace Basarab\HandmadeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="handmades")
 * @ORM\HasLifecycleCallbacks
 */
class Handmade
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    public $comments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="handmades")
     */
    public $author;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="handmades", cascade={"persist"})
     */
    public $tags;

    /**
     * @ORM\OneToMany(targetEntity="File", mappedBy="handmade", cascade={"persist"})
     */
    public $files;

    private $uploadedFiles;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    public $slug;

    /**
     * @ORM\Column(type="datetime")
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
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Handmade
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
     * Set text
     *
     * @param string $text
     *
     * @return Handmade
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add comment
     *
     * @param \Basarab\HandmadeBundle\Entity\Comment $comment
     *
     * @return Handmade
     */
    public function addComment(\Basarab\HandmadeBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \Basarab\HandmadeBundle\Entity\Comment $comment
     */
    public function removeComment(\Basarab\HandmadeBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set author
     *
     * @param \Basarab\HandmadeBundle\Entity\User $author
     *
     * @return Handmade
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
     * Add tag
     *
     * @param \Basarab\HandmadeBundle\Entity\Tag $tag
     *
     * @return Handmade
     */
    public function addTag(\Basarab\HandmadeBundle\Entity\Tag $tag)
    {
        $tag->addHandmade($this);
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Basarab\HandmadeBundle\Entity\Tag $tag
     */
    public function removeTag(\Basarab\HandmadeBundle\Entity\Tag $tag)
    {
        $tag->removeHandmade($this);
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add file
     *
     * @param \Basarab\HandmadeBundle\Entity\File $file
     *
     * @return Handmade
     */
    public function addFile(\Basarab\HandmadeBundle\Entity\File $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \Basarab\HandmadeBundle\Entity\File $file
     */
    public function removeFile(\Basarab\HandmadeBundle\Entity\File $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Get files
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Handmade
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

    /**
     * Set like
     *
     * @param integer $like
     *
     * @return Handmade
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like
     *
     * @return integer
     */
    public function getLike()
    {
        return $this->like;
    }

    public function setUploadedFiles(array $uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        foreach($this->uploadedFiles as $uploadedFile)
        {
            $file = new File();

            /*
             * These lines could be moved to the File Class constructor to factorize
             * the File initialization and thus allow other classes to own Files
             */
            $path = sha1(uniqid(mt_rand(), true)).'.'. $uploadedFile->guessExtension();
            $file->setPath($path);

            $uploadedFile->move($this->getUploadRootDir(), $path);

            $this->getFiles()->add($file);
            $file->setHandmade($this);

            unset($uploadedFile);
        }
    }

    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/handmades/';
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
