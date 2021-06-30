<?php


namespace App\Controller\Admin;


use App\Entity\Base\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class BaseCrudController extends AbstractCrudController
{
    //TODO: soft delete action

    protected $pageSize;
    protected $sort;

    public function __construct(){
        $this->pageSize = 100;
        $this->sort = ['title' => 'ASC'];
    }

    public static function getEntityFqcn(): string
    {
        return "";
    }

    protected function getSiteBadgeField(): AssociationField
    {
        $sites = $this->getDoctrine()
            ->getRepository(Site::class)
            ->createQueryBuilder('s')
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->getBadgeField($sites, AssociationField::new('site'));
    }

    protected function getBadgeField($choices, AssociationField $field): AssociationField
    {
         return $field->setFormTypeOptions(["choices" => $choices])
            ->setTemplatePath('admin/colorBadgeField.html.twig')
            ->setRequired(true)
            ->setSortable(false);
    }

    protected function getFeaturedImagePath(): string
    {
            return $this->getParameter('path.featured.images');
    }

    protected function getFeaturedImagePublicPath(): string
    {
        return $this->getParameter('path.public.featured.images');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize($this->pageSize)
            ->setDefaultSort($this->sort);
    }
}