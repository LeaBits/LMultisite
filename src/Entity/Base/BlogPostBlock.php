<?php

namespace App\Entity\Base;

use App\Repository\Base\BlogPostBlockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostBlockRepository::class)
 */
class BlogPostBlock extends ContentBlock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=BlogPost::class, inversedBy="blogPostBlocks")
     */
    private $blogPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogPost(): ?BlogPost
    {
        return $this->blogPost;
    }

    public function setBlogPost(?BlogPost $blogPost): self
    {
        $this->blogPost = $blogPost;

        return $this;
    }
}
