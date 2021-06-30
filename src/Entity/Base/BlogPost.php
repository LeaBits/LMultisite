<?php

namespace App\Entity\Base;

use App\Entity\Base\Traits\Content;
use App\Repository\Base\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 * @Vich\Uploadable
 */
class BlogPost extends Base
{
    use Content;

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

    /**
     * @ORM\OneToMany(targetEntity=BlogPostBlock::class, mappedBy="blogPost")
     */
    private $blogPostBlocks;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="blogPosts")
     */
    private $site;

    public function __construct()
    {
        $this->blogTags = new ArrayCollection();
        $this->blogPostBlocks = new ArrayCollection();
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

    /**
     * @return Collection|BlogPostBlock[]
     */
    public function getBlogPostBlocks(): Collection
    {
        return $this->blogPostBlocks;
    }

    public function addBlogPostBlock(BlogPostBlock $blogPostBlock): self
    {
        if (!$this->blogPostBlocks->contains($blogPostBlock)) {
            $this->blogPostBlocks[] = $blogPostBlock;
            $blogPostBlock->setBlogPost($this);
        }

        return $this;
    }

    public function removeBlogPostBlock(BlogPostBlock $blogPostBlock): self
    {
        if ($this->blogPostBlocks->removeElement($blogPostBlock)) {
            // set the owning side to null (unless already changed)
            if ($blogPostBlock->getBlogPost() === $this) {
                $blogPostBlock->setBlogPost(null);
            }
        }

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}
