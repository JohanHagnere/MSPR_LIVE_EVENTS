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
use App\Repository\FestivalRepository;
use App\Repository\SceneRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Entity\Festival;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity as ConfigurationEntity;

#[Route('{festival}/performer')]
#[ConfigurationEntity('festival', expr: 'repository.find(festival)')]

class PerformerController extends AbstractController
{
    #[Route('/', name: 'app_performer_index', methods: ['GET'])]
    public function index(Festival $festival,  PerformerRepository $performerRepository, ConcertRepository $concertRepository, FestivalRepository $festivalRepository, SceneRepository $sceneRepository): Response
    {
        return $this->render('performer/index.html.twig', [
            'performers' => $performerRepository->findAll(),
            'festival' => $festival,
        ]);
    }

    #[Route('/new', name: 'app_performer_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Festival $festival, Request $request, PerformerRepository $performerRepository): Response
    {
        $performer = new Performer();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performerRepository->save($performer, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performer/new.html.twig', [
            'performer' => $performer,
            'form' => $form,
            'festival' => $festival
        ]);
    }
    #[Route('/{id}', name: 'app_performer_show', methods: ['GET'])]
    #[Entity('festival, expr:repository.find(festival)')]
    public function show(Performer $performer, Festival $festival): Response
    {
        return $this->render('performer/show.html.twig', [
            'performer' => $performer,
            'festival' => $festival,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_performer_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Performer $performer, Festival $festival, PerformerRepository $performerRepository): Response
    {
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);
        $festivalId = $festival->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $performerRepository->save($performer, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('performer/edit.html.twig', [
            'performer' => $performer,
            'festival' => $festival,
            'festivalId' => $festivalId,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_performer_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Performer $performer, PerformerRepository $performerRepository, Festival $festival): Response
    {
        $festivalId = $festival->getId();
        if ($this->isCsrfTokenValid('delete' . $performer->getId(), $request->request->get('_token'))) {
            $performerRepository->remove($performer, true);
        }

        return $this->redirectToRoute('app_administration', ['festivalId' => $festivalId], Response::HTTP_SEE_OTHER);
    }
}
