<?php

namespace App\Controller\Post;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/review/{id}/update', name: 'review_update', methods: ['POST'])]
    public function updateReview(
        Review $review,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $data = $request->request->all();

        $isVisible = 'Yes' == $data['isVisible'];

        $review->setIsVisible($isVisible);

        $entityManager->persist($review);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Review updated successfully']);
    }
}
