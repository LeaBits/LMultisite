<?php

namespace App\Entity\Base;

use App\Repository\Base\NavigationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NavigationRepository::class)
 */
class Navigation extends Base
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
     * @ORM\OneToMany(targetEntity=NavigationPage::class, mappedBy="navigation")
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

    //TODO: save site

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
            $navigationPage->setNavigation($this);
        }

        return $this;
    }

    public function removeNavigationPage(NavigationPage $navigationPage): self
    {
        if ($this->navigationPages->removeElement($navigationPage)) {
            // set the owning side to null (unless already changed)
            if ($navigationPage->getNavigation() === $this) {
                $navigationPage->setNavigation(null);
            }
        }

        return $this;
    }
}
