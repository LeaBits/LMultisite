<?php

namespace App\Controller\Admin;

use App\Entity\Base\NavigationPage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NavigationPageCrudController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->sort = ['id' => 'ASC'];
    }

    public static function getEntityFqcn(): string
    {
        return NavigationPage::class;
    }

    // TODO: Navigation Page CRUD
}
