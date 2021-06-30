<?php

namespace App\Controller\Admin;

use App\Entity\Base\Page;
use App\Entity\Base\PageBlock;
use App\Entity\Base\TemplateBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PageBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield BooleanField::new('is_published')
            ->renderAsSwitch(false);

        $pages = $this->getDoctrine()
            ->getRepository(Page::class)
            ->createQueryBuilder('p')
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult();
        $pageField = AssociationField::new('page');
        yield $pageField->setFormTypeOptions(["choices" => $pages])
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
