<?php

namespace App\Controller;

use App\Entity\Invitation;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\OpeningHourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class InvitationController extends AbstractController
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/invitation/{uuid}', name: 'app_invitation')]
    public function index(Invitation $invitation, Request $request, OpeningHourRepository $openingHourRepository): Response
    {
        // If the invitation has already been used, redirect to the login page
        if ($invitation->getTheUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = new User();
        $user->setEmail($invitation->getEmail());

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $invitation->setTheUser($user);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_profile_show', ['profileNumber' => 'EMP-'.$user->getId()]);
        }

        $page_name = 'invitation';

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'page_name' => $page_name,
            'openingHours' => $openingHourRepository->getSortedOpeningHours(),
        ]);
    }
}
