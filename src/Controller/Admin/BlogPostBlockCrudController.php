<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogPostBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogPostBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogPostBlock::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
