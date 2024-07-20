<?php

namespace App\Controller;

use App\Repository\OpeningHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationsController extends AbstractController
{
    #[Route('/informations', name: 'app_informations')]
    public function index(OpeningHourRepository $openingHourRepository): Response
    {
        $page_name = 'informations';

        return $this->render('zoo-informations/index.html.twig', [
            'controller_name' => 'InformationsController',
            'page_name' => $page_name,
            'openingHours' => $openingHourRepository->getSortedOpeningHours(),
        ]);
    }
}
