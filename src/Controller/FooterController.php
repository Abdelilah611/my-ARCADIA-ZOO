<?php

namespace App\Controller;

use App\Repository\OpeningHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FooterController extends AbstractController
{
    private OpeningHourRepository $openingHourRepository;

    public function __construct(OpeningHourRepository $openingHourRepository)
    {
        $this->openingHourRepository = $openingHourRepository;
    }

    public function footer(): Response
    {
        $openingHours = $this->openingHourRepository->getSortedOpeningHours();

        return $this->render('components/_footer.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}
