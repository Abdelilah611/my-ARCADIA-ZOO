<?php

// src/Controller/Post/ContactController.php

namespace App\Controller\Post;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $page_name = 'contact';

        $email = (new TemplatedEmail())
            ->from($request->get('email'))
            ->to('lorenzo.florenty@gmail.com')
            ->subject('You\'ve been contacted by '.$request->get('name'))
            ->htmlTemplate('emails/mail.html')
            ->context([
                'name' => $request->get('name'),
                'message' => $request->get('message'),
            ]);

        $mailer->send($email);

        return new JsonResponse(['message' => 'Email sent successfully!']);
    }
}
