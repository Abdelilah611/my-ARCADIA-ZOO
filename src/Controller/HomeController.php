<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\OpeningHourRepository;
use App\Repository\ReviewRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        HabitatRepository $habitatRepository,
        AnimalRepository $animalRepository,
        ServiceRepository $serviceRepository,
        ReviewRepository $reviewRepository,
        OpeningHourRepository $openingHourRepository
    ): Response {
        $page_name = 'home';

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'page_name' => $page_name,
            'habitats' => $habitatRepository->allHabitats(),
            'spotlighted' => $animalRepository->spotlighted(),
            'services' => $serviceRepository->findAll(),
            'reviews' => $reviewRepository->visibleReviews(),
            'openingHours' => $openingHourRepository->getSortedOpeningHours(),
        ]);
    }
}
