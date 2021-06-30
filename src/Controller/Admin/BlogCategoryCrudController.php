<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogCategoryCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield BooleanField::new('is_published')
            ->renderAsSwitch(false);
        yield TextField::new('title');
        yield TextField::new('slug')
            ->hideOnIndex();
    }
}
