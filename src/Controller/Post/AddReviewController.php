<?php

// src/Controller/Post/AddReviewController.php

namespace App\Controller\Post;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddReviewController extends AbstractController
{
    #[Route('/add-review', name: 'add_review', methods: ['POST'])]
    public function addReview(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $review = new Review();
        $review->setPseudo($request->get('firstname').' '.$request->get('lastname'));
        $review->setComment($request->get('review'));
        $review->setIsVisible(false);

        $entityManager->persist($review);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Review added successfully']);
    }
}
