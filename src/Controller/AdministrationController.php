<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use App\Repository\FestivalRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    #[Route('/administration/{festivalId}', name: 'app_administration')]
    public function index(FestivalRepository $festivalRepository, ConcertRepository $concertRepository, $festivalId): Response
    {

        $festival = $festivalRepository->find($festivalId);

        $concerts = $concertRepository->findByFestival($festival);

        dump($concerts);

        return $this->render('administration/index.html.twig', [
            'festival' => $festival,
            'concerts' => $concerts,
        ]);
    }
}
