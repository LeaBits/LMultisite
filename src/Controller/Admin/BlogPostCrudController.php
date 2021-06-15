<?php

namespace App\Controller\Admin;

use App\Entity\Base\BlogPost;
use App\Entity\Base\Template;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield $this->getSiteBadgeField();
        yield BooleanField::new('is_published')
            ->renderAsSwitch(false);
        yield TextField::new('title');
        yield TextField::new('slug')
            ->hideOnIndex();

        $templates = $this->getDoctrine()
            ->getRepository(Template::class)
            ->createQueryBuilder('t')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();
        $templateField = AssociationField::new('template');
        yield $templateField->setFormTypeOptions(["choices" => $templates])
            ->setSortable(false)
            ->hideOnIndex();

        //TODO: categories
        //TODO: tags

        yield DateField::new('createdAt')
            ->onlyOnIndex();
        yield DateField::new('updatedAt')
            ->onlyOnIndex();
    }
}
