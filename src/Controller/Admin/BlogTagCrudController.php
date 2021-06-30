<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogTagCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogTag::class;
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
