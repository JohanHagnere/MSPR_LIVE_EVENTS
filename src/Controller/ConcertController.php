<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Entity\Festival;
use App\Form\ConcertType;
use App\Repository\ConcertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity as ConfigurationEntity;

#[Route('/{festival}/concert')]
#[ConfigurationEntity('festival', expr: 'repository.find(festival)')]
class ConcertController extends AbstractController
{
    #[Route('/', name: 'app_concert_index', methods: ['GET'])]
    public function index(Festival $festival, ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/index.html.twig', [
            'concerts' => $concertRepository->findAll(),
            'festival' => $festival
        ]);
    }

    #[Route('/new', name: 'app_concert_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Festival $festival, Request $request, ConcertRepository $concertRepository): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concertRepository->save($concert, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('concert/new.html.twig', [
            'concert' => $concert,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_concert_show', methods: ['GET'])]
    public function show(Festival $festival, Concert $concert): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $concert,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}/edit', name: 'app_concert_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Festival $festival, Request $request, Concert $concert, ConcertRepository $concertRepository): Response
    {
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);
        dump($festival);
        if ($form->isSubmitted() && $form->isValid()) {
            $concertRepository->save($concert, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('concert/edit.html.twig', [
            'concert' => $concert,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_concert_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Festival $festival, Request $request, Concert $concert, ConcertRepository $concertRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $concert->getId(), $request->request->get('_token'))) {
            $concertRepository->remove($concert, true);
        }

        return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
    }
}
