<?php

namespace App\Controller\Admin;

use App\Entity\Admin\User;
use App\Entity\Base\BlogCategory;
use App\Entity\Base\BlogPost;
use App\Entity\Base\BlogPostBlock;
use App\Entity\Base\BlogTag;
use App\Entity\Base\Navigation;
use App\Entity\Base\NavigationPage;
use App\Entity\Base\Page;
use App\Entity\Base\PageBlock;
use App\Entity\Base\Site;
use App\Entity\Base\SiteHostname;
use App\Entity\Base\Template;

use App\Entity\Base\TemplateBlock;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LMultisite');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fas fa-paper-plane');

        yield MenuItem::section('Base');
        yield MenuItem::linkToCrud('Sites', 'fa fa-home', Site::class);
        yield MenuItem::linkToCrud('Hostnames', 'fas fa-globe', SiteHostname::class);
        yield MenuItem::linkToCrud('Templates', 'fas fa-file-image', Template::class);
        yield MenuItem::linkToCrud('Template blocks', 'fas fa-cubes', TemplateBlock::class);

        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Pages', 'fas fa-file', Page::class);
        yield MenuItem::linkToCrud('Page blocks', 'fas fa-cubes', PageBlock::class);
        yield MenuItem::linkToCrud('Menus', 'fas fa-compass', Navigation::class);
        yield MenuItem::linkToCrud('Pages in menus', 'far fa-compass', NavigationPage::class);

        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('Posts', 'fas fa-file', BlogPost::class);
        yield MenuItem::linkToCrud('Post blocks', 'fas fa-cubes', BlogPostBlock::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tag', BlogCategory::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-hashtag', BlogTag::class);

        //TODO: Contact form

        yield MenuItem::section('Security');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
    }
}
