<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SponsorRepository::class)
 */
class Sponsor
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
    private $nom_sp;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_sp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_sp;

    /**
     * @ORM\OneToMany(targetEntity=Evenement::class, mappedBy="Sponsors")
     */
    private $evenements;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSp(): ?string
    {
        return $this->nom_sp;
    }

    public function setNomSp(string $nom_sp): self
    {
        $this->nom_sp = $nom_sp;

        return $this;
    }

    public function getNumSp(): ?int
    {
        return $this->num_sp;
    }

    public function setNumSp(int $num_sp): self
    {
        $this->num_sp = $num_sp;

        return $this;
    }

    public function getEmailSp(): ?string
    {
        return $this->email_sp;
    }

    public function setEmailSp(string $email_sp): self
    {
        $this->email_sp = $email_sp;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setSponsors($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getSponsors() === $this) {
                $evenement->setSponsors(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
    return (string) $this->getNomSp();
    }
}

