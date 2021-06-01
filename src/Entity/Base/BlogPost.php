<?php

namespace App\Entity\Base;

use App\Repository\Base\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

//TODO: Uploadable

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
class BlogPost extends Base
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=BlogCategory::class, inversedBy="blogPosts")
     */
    private $blogCategory;

    /**
     * @ORM\ManyToMany(targetEntity=BlogTag::class, mappedBy="blogPosts")
     */
    private $blogTags;

    /**
     * @ORM\ManyToOne(targetEntity=Template::class, inversedBy="blogPosts")
     */
    private $template;

    public function __construct()
    {
        $this->blogTags = new ArrayCollection();
    }

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getBlogCategory(): ?BlogCategory
    {
        return $this->blogCategory;
    }

    public function setBlogCategory(?BlogCategory $blogCategory): self
    {
        $this->blogCategory = $blogCategory;

        return $this;
    }

    /**
     * @return Collection|BlogTag[]
     */
    public function getBlogTags(): Collection
    {
        return $this->blogTags;
    }

    public function addBlogTag(BlogTag $blogTag): self
    {
        if (!$this->blogTags->contains($blogTag)) {
            $this->blogTags[] = $blogTag;
            $blogTag->addBlogPost($this);
        }

        return $this;
    }

    public function removeBlogTag(BlogTag $blogTag): self
    {
        if ($this->blogTags->removeElement($blogTag)) {
            $blogTag->removeBlogPost($this);
        }

        return $this;
    }

    public function getTemplate(): ?Template
    {
        return $this->template;
    }

    public function setTemplate(?Template $template): self
    {
        $this->template = $template;

        return $this;
    }
}
