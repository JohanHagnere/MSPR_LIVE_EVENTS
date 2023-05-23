<?php

namespace App\Controller;

use App\Entity\Performer;
use App\Form\PerformerType;
use App\Repository\PerformerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertRepository;

#[Route('/performer')]
class PerformerController extends AbstractController
{
    #[Route('/', name: 'app_performer_index', methods: ['GET'])]
    public function index(PerformerRepository $performerRepository, ConcertRepository $concertRepository): Response
    {
        return $this->render('performer/index.html.twig', [
            'performers' => $performerRepository->findAll(),
            'concerts' => $concertRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_performer_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, PerformerRepository $performerRepository): Response
    {
        $performer = new Performer();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performerRepository->save($performer, true);

            return $this->redirectToRoute('app_performer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performer/new.html.twig', [
            'performer' => $performer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_performer_show', methods: ['GET'])]
    public function show(Performer $performer): Response
    {
        return $this->render('performer/show.html.twig', [
            'performer' => $performer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_performer_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Performer $performer, PerformerRepository $performerRepository): Response
    {
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performerRepository->save($performer, true);

            return $this->redirectToRoute('app_performer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performer/edit.html.twig', [
            'performer' => $performer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_performer_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Performer $performer, PerformerRepository $performerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $performer->getId(), $request->request->get('_token'))) {
            $performerRepository->remove($performer, true);
        }

        return $this->redirectToRoute('app_performer_index', [], Response::HTTP_SEE_OTHER);
    }
}
