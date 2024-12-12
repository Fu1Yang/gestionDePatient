<?php

namespace App\Controller;

use App\Entity\Secretary;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/secretaries', name: 'app_api_secretaries')]
    public function getSecretaries(EntityManagerInterface $em)
    {
         // Récupérer toutes les données de la table 'secretary'
        $secretaries = $em->getRepository(Secretary::class)->findAll();
        $data = [];
        foreach ($secretaries as $secretary) {
              // Transforme les données en un tableau associatif
            $data[] = [
                'id' => $secretary->getId(),
                'genre' => $secretary->getGenre(),
                'name' => $secretary->getName(),
                'firstname' => $secretary->getFirstname(),
                'adresse' => $secretary->getAdresse(),
                'phone' => $secretary->getPhone(),
                'email' => $secretary->getEmail(),
            ];
        }
        // Retourne la réponse em JSON
    }
}
