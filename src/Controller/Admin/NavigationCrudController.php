<?php

namespace App\Controller\Admin;

use App\Entity\Base\Navigation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NavigationCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Navigation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('title');
        yield TextField::new('slug')
            ->hideOnIndex();
    }
}
