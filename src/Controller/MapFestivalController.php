<?php

namespace App\Controller;

use App\Repository\FacilityRepository;
use App\Repository\FestivalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class MapFestivalController extends AbstractController
{
    #[Route('/map/festival', name: 'app_map_festival')]
    public function index(FacilityRepository $facilityRepository, SerializerInterface $serializer, FestivalRepository $festivalRepository): Response
    {
        // Ici il faudra passer l'id du festival sur lequel l'utilisateur à cliqué
        $festival = $festivalRepository->find(1);
        $markers = $facilityRepository->findByFestival($festival);
        $newMarkers = [];
        $newLocation = ['longitude' => $festival->getLongitude(), 'latitude' => $festival->getLatitude(), 'bounds' => $festival->getBounds()];
        foreach ($markers as $marker) {
            $markerTable = [
                'name' => $marker->getName(),
                'longitude' => $marker->getLongitude(),
                'latitude' => $marker->getLatitude(),
                'img' => $marker->getImg(),
                'category' => $marker->getCategory(),
                'description' => $marker->getDescription()
            ];
            $newMarkers[] = $markerTable;
        }
        return $this->render('map_festival/index.html.twig', [
            'controller_name' => 'MapFestivalController',
            'markers' => json_encode($newMarkers),
            'festivalLocation' => json_encode($newLocation),
        ]);
    }
}
