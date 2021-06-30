<?php


namespace App\Entity\Base\Traits;


use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

trait Content
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $featuredImage;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    protected $featuredImageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime
     */
    protected $featuredImageUpdatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getFeaturedImage(): ?string
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(string $image): self
    {
        $this->featuredImage = $image;

        return $this;
    }

    public function setFeaturedImageFile(File $image = null)
    {
        $this->featuredImageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->featuredImageUpdatedAt = new DateTime('now');
        }
    }

    public function getFeaturedImageFile()
    {
        return $this->featuredImageFile;
    }

    public function getFeaturedImageUpdatedAt(): ?\DateTimeInterface
    {
        return $this->featuredImageUpdatedAt;
    }

    public function setFeaturedImageUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->featuredImageUpdatedAt = $updatedAt;

        return $this;
    }
}