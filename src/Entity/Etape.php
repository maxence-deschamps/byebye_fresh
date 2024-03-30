<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\Etape::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'etape')]
    private Collection $sousEtapes;

    public function __construct(
        #[ORM\Column(type: Types::INTEGER, nullable: false)]
        private int $numero,

        #[ORM\ManyToOne(targetEntity: Recette::class, cascade: ['persist', 'remove'], inversedBy: 'etapes')]
        private Recette $recette,

        #[ORM\Column(type: Types::TEXT, nullable: false)]
        private string $description,

        #[ORM\ManyToOne(targetEntity: Etape::class, cascade: ['persist', 'remove'], inversedBy: 'sousEtapes')]
        private ?Etape $etape = null,
    ) {
        $this->etape?->ajouterSousEtape($this);
        $this->recette->ajouterEtape($this);

        $this->sousEtapes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getRecette(): Recette
    {
        return $this->recette;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getEtape(): ?Etape
    {
        return $this->etape;
    }

    public function getSousEtapes(): Collection
    {
        return $this->sousEtapes;
    }

    public function ajouterSousEtape(Etape $etape): void
    {
        if (!$this->sousEtapes->contains($etape)) {
            $this->sousEtapes->add($etape);
        }
    }
}
