<?php

namespace App\Controller\Admin;

use App\Entity\Base\Navigation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NavigationCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Navigation::class;
    }

    // TODO: Navigation CRUD
}
