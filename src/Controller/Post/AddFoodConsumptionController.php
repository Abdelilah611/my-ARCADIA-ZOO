<?php

// src/Controller/Post/AddFoodConsumptionController.php

namespace App\Controller\Post;

use App\Entity\Animal;
use App\Entity\FoodConsumption;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddFoodConsumptionController extends AbstractController
{
    #[Route('/add-food-consumption', name: 'add_food_consumption', methods: ['POST', 'GET'])]
    public function addFoodConsumption(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $data = $request->request->all();
        var_dump($data);

        /** @var User $user */
        $user = $this->getUser();
        /** @var Animal $animal */
        $animal = $entityManager->getRepository(Animal::class)->find($data['animal']);
        /** @var \DateTime $date */
        $date = \DateTime::createFromFormat('Y-m-d H:i', $data['date']);

        $foodConsumption = new FoodConsumption();
        $foodConsumption->setEmployee($user);
        $foodConsumption->setAnimal($animal);
        $foodConsumption->setDate($date);
        $foodConsumption->setDetail($data['detail']);

        $entityManager->persist($foodConsumption);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Food consumption added successfully']);
    }
}
