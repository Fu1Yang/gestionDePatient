<?php

namespace App\Controller;

use App\Entity\HistoryRdv;
use App\Form\HistoryRdvType;
use App\Repository\HistoryRdvRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/history/rdv')]
final class HistoryRdvController extends AbstractController
{
    #[Route(name: 'app_history_rdv_index', methods: ['GET'])]
    public function index(HistoryRdvRepository $historyRdvRepository): Response
    {
        return $this->render('history_rdv/index.html.twig', [
            'history_rdvs' => $historyRdvRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_history_rdv_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $historyRdv = new HistoryRdv();
        $form = $this->createForm(HistoryRdvType::class, $historyRdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($historyRdv);
            $entityManager->flush();

            return $this->redirectToRoute('app_history_rdv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('history_rdv/new.html.twig', [
            'history_rdv' => $historyRdv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_history_rdv_show', methods: ['GET'])]
    public function show(HistoryRdv $historyRdv): Response
    {
        return $this->render('history_rdv/show.html.twig', [
            'history_rdv' => $historyRdv,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_history_rdv_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HistoryRdv $historyRdv, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HistoryRdvType::class, $historyRdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_history_rdv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('history_rdv/edit.html.twig', [
            'history_rdv' => $historyRdv,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_history_rdv_delete', methods: ['POST'])]
    public function delete(Request $request, HistoryRdv $historyRdv, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historyRdv->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($historyRdv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_history_rdv_index', [], Response::HTTP_SEE_OTHER);
    }
}
