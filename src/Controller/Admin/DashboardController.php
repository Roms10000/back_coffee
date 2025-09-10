<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator; 
use App\Entity\Boisson;
use App\Entity\Archive;
use App\Entity\Categorie;
use App\Entity\Favoris;
use App\Entity\Produit;
use App\Entity\Recette;
use App\Entity\User;
use App\Entity\Type;
use App\Entity\Intensity;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Back Coffee');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Les boissons', 'fas fa-list', Boisson::class);
        yield MenuItem::linkToCrud('Les produits', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Les categories', 'fas fa-tags', Categorie::class);         
        yield MenuItem::linkToCrud('Les intensité', 'fas fa-list', Intensity::class);
        yield MenuItem::linkToCrud('Les types', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Les recettes', 'fas fa-list', Recette::class);
        yield MenuItem::linkToCrud('Les archives', 'fas fa-archive', Archive::class);
        yield MenuItem::linkToCrud('Les favoris', 'fas fa-star', Favoris::class);
    }
}
