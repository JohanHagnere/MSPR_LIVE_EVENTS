<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use App\Repository\FacilityRepository;
use App\Repository\FestivalRepository;
use App\Repository\PerformerRepository;
use App\Repository\SceneRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{
    #[Route('/administration/{festivalId}', name: 'app_administration')]
    public function index(FestivalRepository $festivalRepository, ConcertRepository $concertRepository, $festivalId, PerformerRepository $performerRepository, SceneRepository $sceneRepository, FacilityRepository $facilityRepository): Response
    {
        $festivals = $festivalRepository->findAll();
        $festival = $festivalRepository->find($festivalId);
        $concerts = $concertRepository->findByFestival($festival);
        $scenes = $sceneRepository->findByFestival($festival);
        $performers = $performerRepository->findAll();
        $facilities = $facilityRepository->findByFestival($festival);

        return $this->render('administration/index.html.twig', [
            'festival' => $festival,
            'festivals' => $festivals,
            'concerts' => $concerts,
            'performers' => $performers,
            'festivalId' => $festivalId,
            'facilities' => $facilities,
            'scenes' => $scenes
        ]);
    }
}
