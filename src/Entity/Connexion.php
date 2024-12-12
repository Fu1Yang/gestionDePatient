<?php

namespace App\Entity;

use App\Repository\ConnexionRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ConnexionRepository::class)]
class Connexion implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idUser = null;

    #[ORM\Column(length: 255)]
    private ?string $passworduser = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\ManyToOne(inversedBy: 'connexion')]
    private ?Secretary $secretary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getPassworduser(): ?string
    {
        return $this->passworduser;
    }

    public function setPassworduser(string $passworduser): static
    {
        $this->passworduser = $passworduser;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role ?? 'ROLE_USER'];  // Assurez-vous que 'ROLE_USER' est le rôle de base
    }

    public function getPassword(): string
    {
        return $this->passworduser;
    }

    public function getUserIdentifier(): string
    {
        return $this->idUser;
    }

    public function eraseCredentials():void
    {
        $this->passworduser = null;// Si vous avez des données sensibles, vous pouvez les effacer ici
    }

    public function getSecretary(): ?Secretary
    {
        return $this->secretary;
    }

    public function setSecretary(?Secretary $secretary): static
    {
        $this->secretary = $secretary;

        return $this;
    }
}
