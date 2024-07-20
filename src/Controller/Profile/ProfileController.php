<?php

namespace App\Controller\Profile;

use App\Entity\User;
use App\Repository\AnimalRepository;
use App\Repository\FoodConsumptionRepository;
use App\Repository\ReviewRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile', name: 'app_profile_')]
class ProfileController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $user = $this->getUser();
        $profileId = (new \ReflectionClass($user))->getMethod('getId')->invoke($user);

        return $this->redirectToRoute('app_profile_show', ['profileNumber' => 'EMP-'.$profileId]);
    }

    #[Route('/{profileNumber}', name: 'show')]
    public function show(
        string $profileNumber,
        ReviewRepository $reviewRepository,
        ServiceRepository $serviceRepository,
        FoodConsumptionRepository $foodConsumptionRepository,
        AnimalRepository $animalRepository,
    ): Response {
        $page_name = 'profile';
        $user = $this->getUser();
        $profileId = substr($profileNumber, 4);

        if ((new \ReflectionClass($user))->getMethod('getId')->invoke($user) != $profileId) {
            return $this->redirectToRoute('app_profile_show', ['profileNumber' => 'EMP-'.(new \ReflectionClass($user))->getMethod('getId')->invoke($user)]);
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $profileId]);

        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $lastSixFoodConsumptions = $foodConsumptionRepository->findLastSixByEmployee($user);

        return $this->render('profile/show.html.twig', [
            'user' => $user,
            'page_name' => $page_name,
            'reviews' => $reviewRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'lastFoodConsumptions' => $lastSixFoodConsumptions,
            'animals' => $animalRepository->findAll(),
        ]);
    }
}
