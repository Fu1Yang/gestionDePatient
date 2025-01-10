<?php

namespace App\Controller;

use App\Entity\Connexion;
use App\Form\ConnexionType;
use App\Repository\ConnexionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/')]
final class ConnexionController extends AbstractController
{
    #[Route(name: 'app_connexion_connexion', methods: ['GET'])]
    public function connexion(): Response
    {
        return $this->render('connexion/connexion.html.twig');
    }

    #[Route('/verification', name: 'app_connexion_verification', methods: ['GET', 'POST'])]
    public function verification(Request $request, ConnexionRepository $connexionRepository): JsonResponse
    {
    
        $data = json_decode($request->getContent(), true);
        if (!isset($data['idUser']) || !isset($data['passworduser'])) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Identifiant ou mot de passe manquant',
            ], 400);
        }
    
        $idUser = $data['idUser'];
        $password = $data['passworduser'];
    
        $user = $connexionRepository->findOneBy(['idUser' => $idUser]);
    
        if (!$user) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Utilisateur introuvable',
            ], 404);
        }
    
        if ($user->getPassworduser() !== $password) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Mot de passe incorrect',
            ], 401);
        }
        
        if ($user->getPassworduser() == $password && $user->getIdUser()== $idUser) {
            if ($user->getRole() === 'secretary') {
                return new JsonResponse([
                    'status' => 'success',
                    'message' => 'Connexion réussie',
                    'redirectUrl' => '/secretary/account', // Indique l'URL vers laquelle rediriger l'utilisateur
                ]);
            }
            if ($user->getRole() === 'patient') {
                return new JsonResponse([
                    'status' => 'success',
                    'message' => 'Connexion réussie',
                    'redirectUrl' => '/patient/account', // Indique l'URL vers laquelle rediriger l'utilisateur

                ]);
            }
       
        }
    }
    

    #[Route('/index', name: 'app_connexion_index', methods: ['GET'])]
    public function index(ConnexionRepository $connexionRepository): Response
    {
        return $this->render('connexion/index.html.twig', [
            'connexions' => $connexionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_connexion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $connexion = new Connexion();
        $form = $this->createForm(ConnexionType::class, $connexion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($connexion);
            $entityManager->flush();

            return $this->redirectToRoute('app_connexion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connexion/new.html.twig', [
            'connexion' => $connexion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_connexion_show', methods: ['GET'])]
    public function show(Connexion $connexion): Response
    {
        return $this->render('connexion/show.html.twig', [
            'connexion' => $connexion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_connexion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Connexion $connexion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConnexionType::class, $connexion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_connexion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connexion/edit.html.twig', [
            'connexion' => $connexion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_connexion_delete', methods: ['POST'])]
    public function delete(Request $request, Connexion $connexion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$connexion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($connexion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_connexion_index', [], Response::HTTP_SEE_OTHER);
    }
}
