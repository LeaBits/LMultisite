<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogCategoryCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogCategory::class;
    }

    // TODO: Blog Category CRUD
}
