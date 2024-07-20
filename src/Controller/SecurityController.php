<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $page_name = 'login';
        if ($this->getUser()) {
            return $this->redirectToRoute('app_profile_show', ['profileNumber' => 'EMP-'.(new \ReflectionClass($this->getUser()))->getMethod('getId')->invoke($this->getUser())]);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'page_name' => $page_name]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        $page_name = 'logout';
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
