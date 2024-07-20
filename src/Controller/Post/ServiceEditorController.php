<?php

namespace App\Controller\Post;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceEditorController extends AbstractController
{
    #[Route('/service/{id}/update', name: 'service_update', methods: ['POST'])]
    public function updateService(Service $service, Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = $request->request->all();

        $service->setLabel($data['label']);
        $service->setDescription($data['description']);
        $service->setLongDescription($data['longDescription']);
        $service->setTextBtn($data['textBtn']);

        $entityManager->persist($service);
        $entityManager->flush();

        return new JsonResponse(['success' => true, 'message' => 'Service updated successfully']);
    }
}
