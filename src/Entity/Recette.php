<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\Recette::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false, options:['default' => 'CURRENT_TIMESTAMP'])]
    private DateTimeImmutable $dateDeCreation;

    /**
     * @var Collection<int, RecetteIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: 'recette')]
    private Collection $recetteIngredients;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\OneToMany(targetEntity: Etape::class, mappedBy: 'recette')]
    private Collection $etapes;

    /**
     * @param Collection<int, RecetteIngredient> $recetteIngredients
     */
    public function __construct(
        #[ORM\Column(type: Types::STRING, nullable: false)]
        private string $titre,

        #[ORM\Column(type: Types::INTEGER, nullable: false)]
        private int $dureeDePreparation,

        #[ORM\Column(type: Types::INTEGER, nullable: false)]
        private int $dureeDePreparationAvecCuisson,

        #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
        private ?Utilisateur $auteur = null,

        #[ORM\Column(type: Types::TEXT, nullable: true)]
        private ?string $description = null,

        array $recetteIngredients = [],
    ) {
        $this->recetteIngredients = new ArrayCollection($recetteIngredients);
        $this->etapes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateDeCreation(): DateTimeImmutable
    {
        return $this->dateDeCreation;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDureeDePreparation(): int
    {
        return $this->dureeDePreparation;
    }

    public function getDureeDePreparationAvecCuisson(): int
    {
        return $this->dureeDePreparationAvecCuisson;
    }

    /**
     * @return Collection<int, RecetteIngredient>
     */
    public function getRecetteIngredients(): Collection
    {
        return $this->recetteIngredients;
    }

    public function ajouterRecetteIngredient(RecetteIngredient $recetteIngredient): void
    {
        if (!$this->recetteIngredients->contains($recetteIngredient)) {
            $this->recetteIngredients->add($recetteIngredient);
        }
    }

    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function ajouterEtape(Etape $etape): void
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
        }
    }

    public function estVegetarien(): bool
    {
        return $this->recetteIngredients
            ->map(fn (RecetteIngredient $recetteIngredient) => !$recetteIngredient->getIngredient()->estVegetarien())
            ->isEmpty();
    }
}
