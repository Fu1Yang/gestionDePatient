<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\PatientAccount;
use App\Form\PatientAccountType;
use App\Repository\PatientAccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/patient/account')]
final class PatientAccountController extends AbstractController
{
    #[Route('/', name: 'app_patient_account', methods: ['GET'])]
    public function account( ): Response
    {
        return $this->render('patient_account/account.html.twig');
    }

    #[Route('/rdv', name: 'app_patient_account_rdv', methods: ['GET'])]
    public function rdv(): Response
    {
        return $this->render('patient_account/rdv.html.twig');
    }

    #[Route('/newPatient', name: 'app_patient_account_newPatient', methods: ['POST'])]
    public function newPatient(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Décodage des données JSON
        $data = json_decode($request->getContent(), true);
    
        if (!$data || !isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json(['error' => 'Email invalide ou données manquantes'], 400);
        }
    
        try {
            // Création et mapping des données sur l'entité
            $patientAccount = new PatientAccount();
            $patientAccount->setEmail($data['email']);
            $patientAccount->setNom($data['nom'] ?? '');
            $patientAccount->setPrenom($data['prenom'] ?? '');
            $patientAccount->setAdresse($data['adresse'] ?? '');
            $patientAccount->setTel($data['tel'] ?? '');
            $patientAccount->setGenre($data['genre'] ?? '');
    
            // Sauvegarde en base de données
            $entityManager->persist($patientAccount);
            $entityManager->flush();
    
            return $this->json([
                'success' => true,
                'message' => 'Patient enregistré avec succès',
                'data' => [
                    'id' => $patientAccount->getId(),
                    'email' => $patientAccount->getEmail(),
                ],
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Erreur interne : ' . $e->getMessage()], 500);
        }
    }
    

    #[Route('/index', name: 'app_patient_account_index', methods: ['GET'])]
    public function index(PatientAccountRepository $patientAccountRepository): Response
    {
        return $this->render('patient_account/index.html.twig', [
            'patient_accounts' => $patientAccountRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_patient_account_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $patientAccount = new PatientAccount();
        $form = $this->createForm(PatientAccountType::class, $patientAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($patientAccount);
            $entityManager->flush();

            return $this->redirectToRoute('app_patient_account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient_account/new.html.twig', [
            'patient_account' => $patientAccount,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_account_show', methods: ['GET'])]
    public function show(PatientAccount $patientAccount): Response
    {
        return $this->render('patient_account/show.html.twig', [
            'patient_account' => $patientAccount,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patient_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PatientAccount $patientAccount, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PatientAccountType::class, $patientAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_patient_account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('patient_account/edit.html.twig', [
            'patient_account' => $patientAccount,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_account_delete', methods: ['POST'])]
    public function delete(Request $request, PatientAccount $patientAccount, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patientAccount->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($patientAccount);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_patient_account_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/api_patient/{id}', name: 'app_patient_api', methods: ['GET','POST'])]
    public function api_secretary(int $id, PatientAccountRepository $patientAccountRepository): JsonResponse
    {
        $patient = $patientAccountRepository->find($id);
        
        if (!$patient) {
            return new JsonResponse(['error' => 'Secretary not found'], 404);
        }
    
        return new JsonResponse([
            'data' => [
                'id' => $patient->getId(),
                'genre' => $patient->getGenre(),
                'name' => $patient->getNom(),
                'firstname' => $patient->getPrenom(),
                'adresse' => $patient->getAdresse(),
                'phone' => $patient->getTel(),
                'email' => $patient->getEmail(),
            ]
        ], 200, ['Content-Type' => 'application/json']);
    }
}
