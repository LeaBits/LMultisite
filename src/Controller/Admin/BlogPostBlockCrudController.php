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

    // TODO: Blog Post Block CRUD
}
