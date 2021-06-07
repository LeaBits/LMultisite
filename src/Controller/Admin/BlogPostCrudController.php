<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogPost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogPostCrudController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->sort = ['createdAt' => 'DESC'];
    }

    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    // TODO: Blog Post CRUD
}
