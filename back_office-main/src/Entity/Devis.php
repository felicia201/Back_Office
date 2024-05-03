<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $client_nom = null;

    #[ORM\Column(length: 255)]
    private ?string $client_adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $client_email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_devis = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $montant_total = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $duree_validite = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $termes_conditions = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $informations_supplementaires = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getClientNom(): ?string
    {
        return $this->client_nom;
    }

    public function setClientNom(string $client_nom): static
    {
        $this->client_nom = $client_nom;

        return $this;
    }

    public function getClientAdresse(): ?string
    {
        return $this->client_adresse;
    }

    public function setClientAdresse(string $client_adresse): static
    {
        $this->client_adresse = $client_adresse;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->client_email;
    }

    public function setClientEmail(string $client_email): static
    {
        $this->client_email = $client_email;

        return $this;
    }

    public function getDateDevis(): ?\DateTimeInterface
    {
        return $this->date_devis;
    }

    public function setDateDevis(\DateTimeInterface $date_devis): static
    {
        $this->date_devis = $date_devis;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montant_total;
    }

    public function setMontantTotal(string $montant_total): static
    {
        $this->montant_total = $montant_total;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDureeValidite(): ?int
    {
        return $this->duree_validite;
    }

    public function setDureeValidite(int $duree_validite): static
    {
        $this->duree_validite = $duree_validite;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTermesConditions(): ?string
    {
        return $this->termes_conditions;
    }

    public function setTermesConditions(string $termes_conditions): static
    {
        $this->termes_conditions = $termes_conditions;

        return $this;
    }

    public function getInformationsSupplementaires(): ?string
    {
        return $this->informations_supplementaires;
    }

    public function setInformationsSupplementaires(string $informations_supplementaires): static
    {
        $this->informations_supplementaires = $informations_supplementaires;

        return $this;
    }
}
