<?php

namespace App\Controller\Admin;

use App\Entity\Base\Template;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TemplateCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Template::class;
    }

    // TODO: Template CRUD
}
