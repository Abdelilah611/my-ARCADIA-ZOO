<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\FoodConsumptionRepository;
use App\Repository\HabitatRepository;
use App\Repository\OpeningHourRepository;
use App\Repository\VeterinaryReportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HabitatsController extends AbstractController
{
    #[Route('/habitats', name: 'app_habitats')]
    public function index(
        OpeningHourRepository $openingHourRepository,
        AnimalRepository $animalRepository,
        HabitatRepository $habitatRepository,
        FoodConsumptionRepository $foodConsumptionRepository,
        VeterinaryReportRepository $veterinaryReportRepository
    ): Response {
        $page_name = 'habitats';

        $habitatsWithAnimals = $habitatRepository->getHabitatsWithAnimals();

        $animals = $animalRepository->findAll();

        $animalReports = [];

        foreach ($animals as $animal) {
            $foodConsumption = $animalRepository->findOneByLastFoodConsumptionForAnimal($animal);
            $vetReport = $animalRepository->findOneByLastVetReportForAnimal($animal);

            $animalReports[$animal->getName()] = (object) [
                'vetReport' => $vetReport,
                'foodConsumption' => $foodConsumption,
            ];
        }

        return $this->render('zoo-habitats/index.html.twig', [
            'controller_name' => 'HabitatsController',
            'page_name' => $page_name,
            'openingHours' => $openingHourRepository->getSortedOpeningHours(),
            'habitatsWithAnimals' => $habitatsWithAnimals,
            'animalReports' => $animalReports,
        ]);
    }
}
