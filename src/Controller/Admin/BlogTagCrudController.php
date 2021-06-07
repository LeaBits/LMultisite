<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogTagCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogTag::class;
    }

    // TODO: Blog Tag CRUD
}
