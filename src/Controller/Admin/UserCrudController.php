<?php

namespace App\Controller\Admin;

use App\Entity\Admin\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->sort = ['email' => 'ASC'];
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // TODO: User CRUD
}
