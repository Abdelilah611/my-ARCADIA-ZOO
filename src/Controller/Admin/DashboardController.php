<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\Habitat;
use App\Entity\Image;
use App\Entity\Invitation;
use App\Entity\OpeningHour;
use App\Entity\Race;
use App\Entity\Review;
use App\Entity\Role;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\VeterinaryReport;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(AnimalCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia Zoo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Animaux', 'fa fa-paw', Animal::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Invitations', 'fa fa-envelope', Invitation::class);
        yield MenuItem::linkToCrud('Roles', 'fa fa-lock', Role::class);
        yield MenuItem::linkToCrud('Fiches vétérinaires', 'fa fa-file-medical', VeterinaryReport::class);
        yield MenuItem::linkToCrud('Consommation de nourriture', 'fas fa-drumstick-bite', FoodConsumption::class);
        yield MenuItem::linkToCrud('Heures d\'ouverture', 'fa fa-clock', OpeningHour::class);
        yield MenuItem::linkToCrud('Habitats', 'fa fa-home', Habitat::class);
        yield MenuItem::linkToCrud('Services', 'fa fa-concierge-bell', Service::class);
        yield MenuItem::linkToCrud('Races', 'fa-solid fa-earth-africa', Race::class);
        yield MenuItem::linkToCrud('Avis', 'fa fa-star', Review::class);
        yield MenuItem::linkToCrud('Images', 'fa fa-images', Image::class);
        yield MenuItem::linkToUrl('Retour au site', 'fa fa-file', '/');
    }
}
