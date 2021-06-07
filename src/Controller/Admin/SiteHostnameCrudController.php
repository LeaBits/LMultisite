<?php

namespace App\Controller\Admin;

use App\Entity\Base\Site;
use App\Entity\Base\SiteHostname;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SiteHostnameCrudController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->sort = ['url' => 'ASC'];
    }

    public static function getEntityFqcn(): string
    {
        return SiteHostname::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield $this->getSiteBadgeField();
        yield TextField::new('url');
    }
}
