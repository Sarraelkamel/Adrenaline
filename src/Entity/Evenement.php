<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_ev;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ev;

    /**
     * @ORM\Column(type="time")
     */
    private $heured_ev;

    /**
     * @ORM\Column(type="time")
     */
    private $heuref_ev;

    /**
     * @ORM\ManyToOne(targetEntity=Sponsor::class, inversedBy="evenements")
     */
    private $Sponsors;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEv(): ?string
    {
        return $this->nom_ev;
    }

    public function setNomEv(string $nom_ev): self
    {
        $this->nom_ev = $nom_ev;

        return $this;
    }

    public function getDateEv(): ?\DateTimeInterface
    {
        return $this->date_ev;
    }

    public function setDateEv(\DateTimeInterface $date_ev): self
    {
        $this->date_ev = $date_ev;

        return $this;
    }

    public function getHeuredEv(): ?\DateTimeInterface
    {
        return $this->heured_ev;
    }

    public function setHeuredEv(\DateTimeInterface $heured_ev): self
    {
        $this->heured_ev = $heured_ev;

        return $this;
    }

    public function getHeurefEv(): ?\DateTimeInterface
    {
        return $this->heuref_ev;
    }

    public function setHeurefEv(\DateTimeInterface $heuref_ev): self
    {
        $this->heuref_ev = $heuref_ev;

        return $this;
    }

    public function getSponsors(): ?Sponsor
    {
        return $this->Sponsors;
    }

    public function setSponsors(?Sponsor $Sponsors): self
    {
        $this->Sponsors = $Sponsors;

        return $this;
    }
}
