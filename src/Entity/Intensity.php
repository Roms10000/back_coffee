<?php

namespace App\Entity;

use App\Repository\IntensityRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boisson;

#[ORM\Entity(repositoryClass: IntensityRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['intensity:read']],
    denormalizationContext: ['groups' => ['intensity:write']]
)]
class Intensity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['intensity:read', 'intensity:write', 'boisson:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Boisson>
     */
    #[ORM\OneToMany(targetEntity: Boisson::class, mappedBy: 'intensity')]
    private Collection $boissons;

    public function __construct()
    {
        $this->boissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): static
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons->add($boisson);
            $boisson->setIntensity($this);
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): static
    {
        if ($this->boissons->removeElement($boisson)) {
            // set the owning side to null (unless already changed)
            if ($boisson->getIntensity() === $this) {
                $boisson->setIntensity(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
    return $this->name ?? '';
    }
}
