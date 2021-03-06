<?php

namespace App\Entity\Base;

use App\Repository\Base\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site extends Base
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=SiteHostname::class, mappedBy="site")
     */
    private $siteHostnames;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="site")
     */
    private $pages;

    /**
     * @ORM\OneToMany(targetEntity=BlogPost::class, mappedBy="site")
     */
    private $blogPosts;

    public function __construct()
    {
        $this->siteHostnames = new ArrayCollection();
        $this->pages = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
    }

    public function __toString(){
        return $this->getTitle();
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|SiteHostname[]
     */
    public function getSiteHostnames(): Collection
    {
        return $this->siteHostnames;
    }

    public function addSiteHostname(SiteHostname $siteHostname): self
    {
        if (!$this->siteHostnames->contains($siteHostname)) {
            $this->siteHostnames[] = $siteHostname;
            $siteHostname->setSite($this);
        }

        return $this;
    }

    public function removeSiteHostname(SiteHostname $siteHostname): self
    {
        if ($this->siteHostnames->removeElement($siteHostname)) {
            // set the owning side to null (unless already changed)
            if ($siteHostname->getSite() === $this) {
                $siteHostname->setSite(null);
            }
        }

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
            $page->setSite($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getSite() === $this) {
                $page->setSite(null);
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
            $blogPost->setSite($this);
        }

        return $this;
    }

    public function removeBlogPost(BlogPost $blogPost): self
    {
        if ($this->blogPosts->removeElement($blogPost)) {
            // set the owning side to null (unless already changed)
            if ($blogPost->getSite() === $this) {
                $blogPost->setSite(null);
            }
        }

        return $this;
    }
}
