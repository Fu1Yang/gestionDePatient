<?php

namespace App\Entity;

use App\Repository\SecretaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecretaryRepository::class)]
class Secretary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Connexion>
     */
    #[ORM\OneToMany(targetEntity: Connexion::class, mappedBy: 'secretary')]
    private Collection $connexion;

    public function __construct()
    {
        $this->connexion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Connexion>
     */
    public function getConnexion(): Collection
    {
        return $this->connexion;
    }

    public function addConnexion(Connexion $connexion): static
    {
        if (!$this->connexion->contains($connexion)) {
            $this->connexion->add($connexion);
            $connexion->setSecretary($this);
        }

        return $this;
    }

    public function removeConnexion(Connexion $connexion): static
    {
        if ($this->connexion->removeElement($connexion)) {
            // set the owning side to null (unless already changed)
            if ($connexion->getSecretary() === $this) {
                $connexion->setSecretary(null);
            }
        }

        return $this;
    }
}
