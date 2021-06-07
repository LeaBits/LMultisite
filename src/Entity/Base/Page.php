<?php

namespace App\Entity\Base;

use App\Repository\Base\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

//TODO: Uploadable

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page extends Base
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
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="pages")
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Template::class, inversedBy="pages")
     */
    private $template;

    /**
     * @ORM\OneToMany(targetEntity=NavigationPage::class, mappedBy="page")
     */
    private $navigationPages;

    public function __construct()
    {
        $this->navigationPages = new ArrayCollection();
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

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

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
     * @return Collection|NavigationPage[]
     */
    public function getNavigationPages(): Collection
    {
        return $this->navigationPages;
    }

    public function addNavigationPage(NavigationPage $navigationPage): self
    {
        if (!$this->navigationPages->contains($navigationPage)) {
            $this->navigationPages[] = $navigationPage;
            $navigationPage->setPage($this);
        }

        return $this;
    }

    public function removeNavigationPage(NavigationPage $navigationPage): self
    {
        if ($this->navigationPages->removeElement($navigationPage)) {
            // set the owning side to null (unless already changed)
            if ($navigationPage->getPage() === $this) {
                $navigationPage->setPage(null);
            }
        }

        return $this;
    }
}
