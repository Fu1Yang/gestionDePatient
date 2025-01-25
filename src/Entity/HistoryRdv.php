<?php

namespace App\Entity;

use App\Repository\HistoryRdvRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRdvRepository::class)]
class HistoryRdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255)]
    private ?string $horaires = null;

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPatient = null;

    #[ORM\ManyToOne(inversedBy: 'historyRdvs')]
    private ?PatientAccount $id_history = null;

    #[ORM\Column(length: 255)]
    private ?string $conclusionDuMedecin = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): static
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getNomPatient(): ?string
    {
        return $this->nomPatient;
    }

    public function setNomPatient(string $nomPatient): static
    {
        $this->nomPatient = $nomPatient;

        return $this;
    }

    public function getIdHistory(): ?PatientAccount
    {
        return $this->id_history;
    }

    public function setIdHistory(?PatientAccount $id_history): static
    {
        $this->id_history = $id_history;

        return $this;
    }

    public function getConclusionDuMedecin(): ?string
    {
        return $this->conclusionDuMedecin;
    }

    public function setConclusionDuMedecin(string $conclusionDuMedecin): static
    {
        $this->conclusionDuMedecin = $conclusionDuMedecin;

        return $this;
    }

}
