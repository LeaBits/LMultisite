<?php

namespace App\Entity\Base;

use App\Repository\Base\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemplateRepository::class)
 */
class Template extends Base
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
    private $url;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="template")
     */
    private $pages;

    /**
     * @ORM\OneToMany(targetEntity=BlogPost::class, mappedBy="template")
     */
    private $blogPosts;

    /**
     * @ORM\OneToMany(targetEntity=TemplateBlock::class, mappedBy="template")
     */
    private $templateBlocks;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="pages")
     */
    private $site;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
        $this->templateBlocks = new ArrayCollection();
    }

    public function __toString(){
        return $this->site.': '.$this->getTitle().' ('.$this->getUrl().')';
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setTemplate($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getTemplate() === $this) {
                $page->setTemplate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BlogPost[]
     */
    public function getBlogPosts(): Collection
    {
        return $this->blogPosts;
    }

    public function addBlogPost(BlogPost $blogPost): self
    {
        if (!$this->blogPosts->contains($blogPost)) {
            $this->blogPosts[] = $blogPost;
            $blogPost->setTemplate($this);
        }

        return $this;
    }

    public function removeBlogPost(BlogPost $blogPost): self
    {
        if ($this->blogPosts->removeElement($blogPost)) {
            // set the owning side to null (unless already changed)
            if ($blogPost->getTemplate() === $this) {
                $blogPost->setTemplate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TemplateBlock[]
     */
    public function getTemplateBlocks(): Collection
    {
        return $this->templateBlocks;
    }

    public function addTemplateBlock(TemplateBlock $templateBlock): self
    {
        if (!$this->templateBlocks->contains($templateBlock)) {
            $this->templateBlocks[] = $templateBlock;
            $templateBlock->setTemplate($this);
        }

        return $this;
    }

    public function removeTemplateBlock(TemplateBlock $templateBlock): self
    {
        if ($this->templateBlocks->removeElement($templateBlock)) {
            // set the owning side to null (unless already changed)
            if ($templateBlock->getTemplate() === $this) {
                $templateBlock->setTemplate(null);
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
