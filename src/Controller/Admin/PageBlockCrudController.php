<?php

namespace App\Controller\Admin;

use App\Entity\Base\PageBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageBlockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PageBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {

    }
}
