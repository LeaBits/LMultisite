<?php

namespace App\Controller\Admin;

use App\Entity\Base\Site;
use App\Entity\Base\Template;
use App\Entity\Base\TemplateBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TemplateBlockCrudController extends BaseCrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->sort = ['slug' => 'ASC'];
    }

    public static function getEntityFqcn(): string
    {
        return TemplateBlock::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        $templates = $this->getDoctrine()
            ->getRepository(Template::class)
            ->createQueryBuilder('t')
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();
        $templateField = AssociationField::new('template');
        yield $templateField->setFormTypeOptions(["choices" => $templates])
            ->setSortable(false);

        yield TextField::new('slug')
            ->hideOnIndex();

        yield DateField::new('createdAt')
            ->onlyOnIndex();
        yield DateField::new('updatedAt')
            ->onlyOnIndex();
    }
}
