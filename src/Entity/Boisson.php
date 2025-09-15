<?php

namespace App\Entity;
// use qui résout le probleme de circular réference a cause de relations bidirectionnelles
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
// Groups → contrôle quels champs sont exposés pour read (GET) et write (POST/PUT/PATCH).
// MaxDepth(1) → limite la profondeur de sérialisation pour éviter la boucle infinie.

use App\Repository\BoissonRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Favoris;
use App\Entity\Produit;
use App\Entity\Categorie;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
normalizationContext: ['groups' => ['boisson:read']],
denormalizationContext: ['groups' => ['boisson:write']]
)]
class Boisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['boisson:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['boisson:read' , 'boisson:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 100)]
    private ?string $image = null;

    /**
     * @var Collection<int, Favoris>
     */
    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'boisson', orphanRemoval: true)]
    private Collection $favoris;

    #[ORM\ManyToOne(inversedBy: 'boissons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?categorie $categorie = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'boissons')]
    #[Groups(['boisson:read', 'boisson:write'])]
    #[MaxDepth(1)]
    private Collection $produits;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'boissons')]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'boissons')]
    #[Groups(['boisson:read', 'boisson:write'])]
    private ?Intensity $intensity = null;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setBoisson($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getBoisson() === $this) {
                $favori->setBoisson(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $produit->addBoisson($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeBoisson($this);
        }

        return $this;
    }
    public function __toString(): string
    {
    return $this->name ?? '';
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getIntensity(): ?Intensity
    {
        return $this->intensity;
    }

    public function setIntensity(?Intensity $intensity): static
    {
        $this->intensity = $intensity;

        return $this;
    }
}
