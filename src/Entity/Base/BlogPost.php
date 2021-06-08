<?php

namespace App\Entity\Base;

use App\Entity\Base\Traits\Content;
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
    use Content;

    //TODO: content

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
