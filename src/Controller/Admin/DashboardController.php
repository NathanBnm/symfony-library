<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\BookCollection;
use App\Entity\Chapter;
use App\Entity\Resource;
use App\Entity\Section;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * @return Response
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Library');
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('General');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::section('Library');
        yield MenuItem::linkToCrud('Collections', 'fa fa-swatchbook', BookCollection::class);
        yield MenuItem::linkToCrud('Books', 'fa fa-book', Book::class);
        yield MenuItem::linkToCrud('Chapters', 'fa fa-scroll', Chapter::class);
        yield MenuItem::linkToCrud('Sections', 'fa fa-layer-group', Section::class);
        yield MenuItem::linkToCrud('Resources', 'fa fa-photo-video', Resource::class);
        yield MenuItem::section('Direct access');
        yield MenuItem::linkToRoute('Library', 'fa fa-home', 'app_home');
    }
}
