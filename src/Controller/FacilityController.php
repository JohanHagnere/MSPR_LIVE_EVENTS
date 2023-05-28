<?php

namespace App\Controller;

use App\Entity\Facility;
use App\Entity\Festival;
use App\Form\FacilityType;
use App\Repository\FacilityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity as ConfigurationEntity;


#[Route('/{festival}/facility')]
#[ConfigurationEntity('festival', expr: 'repository.find(festival)')]

class FacilityController extends AbstractController
{
    #[Route('/', name: 'app_facility_index', methods: ['GET'])]
    public function index(Festival $festival, FacilityRepository $facilityRepository): Response
    {
        return $this->render('facility/index.html.twig', [
            'facilities' => $facilityRepository->findAll(),
            'festival' => $festival
        ]);
    }

    #[Route('/new', name: 'app_facility_new', methods: ['GET', 'POST'])]
    public function new(Festival $festival, Request $request, FacilityRepository $facilityRepository): Response
    {
        $facility = new Facility();
        $form = $this->createForm(FacilityType::class, $facility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facilityRepository->save($facility, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facility/new.html.twig', [
            'facility' => $facility,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_facility_show', methods: ['GET'])]
    public function show(Facility $facility): Response
    {
        return $this->render('facility/show.html.twig', [
            'facility' => $facility,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_facility_edit', methods: ['GET', 'POST'])]
    public function edit(Festival $festival, Request $request, Facility $facility, FacilityRepository $facilityRepository): Response
    {
        $form = $this->createForm(FacilityType::class, $facility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $facilityRepository->save($facility, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('facility/edit.html.twig', [
            'facility' => $facility,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_facility_delete', methods: ['POST'])]
    public function delete(Festival $festival, Request $request, Facility $facility, FacilityRepository $facilityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $facility->getId(), $request->request->get('_token'))) {
            $facilityRepository->remove($facility, true);
        }

        return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
    }
}
