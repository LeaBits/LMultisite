<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Field\VichImageField;
use App\Entity\Base\Page;
use App\Entity\Base\Site;
use App\Entity\Base\Template;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends BaseCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield $this->getSiteBadgeField();
        yield BooleanField::new('is_published')
            ->renderAsSwitch(false);
        yield BooleanField::new('is_home')
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

        $uploadPath = $this->getParameter('path.featured.images');
        $uploadPublicPath = $this->getParameter('path.public.featured.images');
        yield ImageField::new('featuredImage')
            ->setBasePath($uploadPath)
            ->setUploadDir($uploadPublicPath)
            ->hideOnForm();
        yield ImageField::new('featuredImage')
            ->setBasePath($uploadPath)
            ->setUploadDir($uploadPublicPath)
            ->onlyOnForms();

        yield DateField::new('createdAt')
            ->onlyOnIndex();
        yield DateField::new('updatedAt')
            ->onlyOnIndex();
    }
}
