<?php


namespace App\Entity\Base;


use Doctrine\ORM\Mapping as ORM;

class ContentBlock extends Base
{
    /**
     * @ORM\ManyToOne(targetEntity=TemplateBlock::class, inversedBy="pageBlocks")
     */
    protected $templateBlock;

    //TODO: CKEditor
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * Returns templateBlock.
     *
     * @return TemplateBlock
     */
    public function getTemplateBlock(): ?TemplateBlock
    {
        return $this->templateBlock;
    }

    /**
     * Sets templateBlock.
     *
     * @return $this
     */
    public function setTemplateBlock(?TemplateBlock $templateBlock): self
    {
        $this->templateBlock = $templateBlock;

        return $this;
    }

    /**
     * Returns content.
     *
     * @return text
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets templateBlock.
     *
     * @return $this
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}