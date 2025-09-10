<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boisson;
use App\Entity\Produit;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $etape = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'recettes')]
    private Collection $produits;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?boisson $boisson = null;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtape(): ?string
    {
        return $this->etape;
    }

    public function setEtape(string $etape): static
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addRecette($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeRecette($this);
        }

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(Boisson $boisson): static
    {
        $this->boisson = $boisson;

        return $this;
    }
}
