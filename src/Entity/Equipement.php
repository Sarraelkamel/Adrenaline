<?php

namespace App\Entity;
use App\Entity\Categorie;
use App\Repository\EquipementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 */
class Equipement
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
    private $nom_eq;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desc_eq;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_eq;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_eq;

    /**
     * @ORM\Column(type="blob")
     */
    private $image_eq;

    /**
     * @ORM\ManyToOne(targetEntity=categorie::class, inversedBy="equipements")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEq(): ?string
    {
        return $this->nom_eq;
    }

    public function setNomEq(string $nom_eq): self
    {
        $this->nom_eq = $nom_eq;

        return $this;
    }

    public function getDescEq(): ?string
    {
        return $this->desc_eq;
    }

    public function setDescEq(string $desc_eq): self
    {
        $this->desc_eq = $desc_eq;

        return $this;
    }

    public function getPrixEq(): ?int
    {
        return $this->prix_eq;
    }

    public function setPrixEq(int $prix_eq): self
    {
        $this->prix_eq = $prix_eq;

        return $this;
    }

    public function getQuantiteEq(): ?int
    {
        return $this->quantite_eq;
    }

    public function setQuantiteEq(int $quantite_eq): self
    {
        $this->quantite_eq = $quantite_eq;

        return $this;
    }

    public function getImageEq()
    {
        return $this->image_eq;
    }

    public function setImageEq($image_eq): self
    {
        $this->image_eq = $image_eq;

        return $this;
    }

    public function getCategory(): ?categorie
    {
        return $this->category;
    }

    public function setCategory(?categorie $category): self
    {
        $this->category = $category;

        return $this;
    }
}
