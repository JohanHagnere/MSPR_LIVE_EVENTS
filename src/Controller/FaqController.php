<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Entity\Festival;
use App\Form\FaqType;
use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/faq')]
class FaqController extends AbstractController
{
    #[Route('/{id}/', name: 'app_faq_index_by_festival', methods: ['GET'])]
    public function index(Festival $festival, FaqRepository $faqRepository): Response
    {
        return $this->render('faq/index.html.twig', [
            'faqs' => $faqRepository->findByFestival($festival),
            'festival' => $festival,
        ]);
    }

    #[Route('/{id}/new', name: 'app_faq_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Festival $festival, Request $request, FaqRepository $faqRepository): Response
    {
        $faq = new Faq();
        $faq->setFestival($festival);
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $faqRepository->save($faq, true);

            return $this->redirectToRoute('app_faq_index_by_festival', ['id' => $faq->getFestival()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('faq/new.html.twig', [
            'faq' => $faq,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_faq_show', methods: ['GET'])]
    // public function show(Faq $faq): Response
    // {
    //     return $this->render('faq/show.html.twig', [
    //         'faq' => $faq,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_faq_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Faq $faq, FaqRepository $faqRepository): Response
    {
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $faqRepository->save($faq, true);

            return $this->redirectToRoute('app_faq_index_by_festival', ['id' => $faq->getFestival()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('faq/edit.html.twig', [
            'faq' => $faq,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_faq_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Faq $faq, FaqRepository $faqRepository): Response
    {
        $festival = $faq->getFestival();
        if ($this->isCsrfTokenValid('delete'.$faq->getId(), $request->request->get('_token'))) {
            $faqRepository->remove($faq, true);
        }

        return $this->redirectToRoute('app_faq_index_by_festival', ['id' => $festival->getId()], Response::HTTP_SEE_OTHER);
    }
}
