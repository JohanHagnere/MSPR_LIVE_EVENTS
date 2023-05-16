<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MessageRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MessageRepository $messageRepository): Response
    {
        $messages = $messageRepository->findBy(['type' => ['urgent', 'important']]);

        return $this->render('home/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}
