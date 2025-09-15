<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boisson;
use App\Entity\User;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['favoris:read']],
    denormalizationContext: ['groups' => ['favoris:write']]
)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boisson $boisson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): static
    {
        $this->boisson = $boisson;

        return $this;
    }
}
