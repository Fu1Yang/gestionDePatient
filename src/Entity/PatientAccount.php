<?php

namespace App\Entity;

use App\Repository\PatientAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientAccountRepository::class)]
class PatientAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'patient_id')]
    private ?Connexion $connexion = null;

    /**
     * @var Collection<int, HistoryRdv>
     */
    #[ORM\OneToMany(targetEntity: HistoryRdv::class, mappedBy: 'id_history')]
    private Collection $historyRdvs;

    public function __construct()
    {
        $this->historyRdvs = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

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

    public function getConnexion(): ?Connexion
    {
        return $this->connexion;
    }

    public function setConnexion(?Connexion $connexion): static
    {
        $this->connexion = $connexion;

        return $this;
    }

    /**
     * @return Collection<int, HistoryRdv>
     */
    public function getHistoryRdvs(): Collection
    {
        return $this->historyRdvs;
    }

    public function addHistoryRdv(HistoryRdv $historyRdv): static
    {
        if (!$this->historyRdvs->contains($historyRdv)) {
            $this->historyRdvs->add($historyRdv);
            $historyRdv->setIdHistory($this);
        }

        return $this;
    }

    public function removeHistoryRdv(HistoryRdv $historyRdv): static
    {
        if ($this->historyRdvs->removeElement($historyRdv)) {
            // set the owning side to null (unless already changed)
            if ($historyRdv->getIdHistory() === $this) {
                $historyRdv->setIdHistory(null);
            }
        }

        return $this;
    }
}
