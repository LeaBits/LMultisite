<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogPost;
use App\Entity\Base\BlogPostBlock;
use App\Entity\Base\Page;
use App\Entity\Base\TemplateBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BlogPostBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPostBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield BooleanField::new('is_published')
            ->renderAsSwitch(false);

        $posts = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->createQueryBuilder('p')
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult();
        $postField = AssociationField::new('blogPost');
        yield $postField->setFormTypeOptions(["choices" => $posts])
            ->setSortable(false);

        $templateBlocks = $this->getDoctrine()
            ->getRepository(TemplateBlock::class)
            ->createQueryBuilder('tb')
            ->orderBy('tb.id', 'ASC')
            ->getQuery()
            ->getResult();
        $templateBlockField = AssociationField::new('templateBlock');
        yield $templateBlockField->setFormTypeOptions(["choices" => $templateBlocks])
            ->setSortable(false);

        yield TextEditorField::new('content')
            ->hideOnIndex();
    }
}
