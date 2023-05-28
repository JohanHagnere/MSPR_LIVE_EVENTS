<?php

namespace App\Controller;

use App\Entity\Festival;
use App\Entity\Scene;
use App\Form\SceneType;
use App\Repository\SceneRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity as ConfigurationEntity;


#[Route('/{festival}/scene')]
#[ConfigurationEntity('festival', expr: 'repository.find(festival)')]

class SceneController extends AbstractController
{
    #[Route('/', name: 'app_scene_index', methods: ['GET'])]
    public function index(Festival $festival, SceneRepository $sceneRepository): Response
    {
        return $this->render('scene/index.html.twig', [
            'scenes' => $sceneRepository->findAll(),
            'festival' => $festival
        ]);
    }

    #[Route('/new', name: 'app_scene_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Festival $festival, Request $request, SceneRepository $sceneRepository): Response
    {
        $scene = new Scene();
        $form = $this->createForm(SceneType::class, $scene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sceneRepository->save($scene, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scene/new.html.twig', [
            'scene' => $scene,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_scene_show', methods: ['GET'])]
    public function show(Scene $scene): Response
    {
        return $this->render('scene/show.html.twig', [
            'scene' => $scene,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_scene_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Festival $festival, Request $request, Scene $scene, SceneRepository $sceneRepository): Response
    {
        $form = $this->createForm(SceneType::class, $scene);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sceneRepository->save($scene, true);

            return $this->redirectToRoute('app_administration', ['festivalId' => $festival->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scene/edit.html.twig', [
            'scene' => $scene,
            'form' => $form,
            'festival' => $festival
        ]);
    }

    #[Route('/{id}', name: 'app_scene_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Festival $festival, Request $request, Scene $scene, SceneRepository $sceneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $scene->getId(), $request->request->get('_token'))) {
            $sceneRepository->remove($scene, true);
        }

        return $this->redirectToRoute('app_administration', ['festivalId' => $festival], Response::HTTP_SEE_OTHER);
    }
}
