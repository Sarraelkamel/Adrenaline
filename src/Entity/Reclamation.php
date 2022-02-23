<?php

namespace App\Entity;


use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_r;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_r;

    /**
     * @ORM\OneToOne(targetEntity=Commande::class, cascade={"persist", "remove"})
     */
    private $reclamation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNomR(): ?string
    {
        return $this->nom_r;
    }

    public function setNomR(string $nom_r): self
    {
        $this->nom_r = $nom_r;

        return $this;
    }

    public function getDescriptionR(): ?string
    {
        return $this->description_r;
    }

    public function setDescriptionR(string $description_r): self
    {
        $this->description_r = $description_r;

        return $this;
    }

    public function getReclamation(): ?Commande
    {
        return $this->reclamation;
    }

    public function setReclamation(?Commande $reclamation): self
    {
        $this->reclamation = $reclamation;

        return $this;
    }
    
}
