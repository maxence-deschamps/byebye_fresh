<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Ingredient\Groupe;
use App\Entity\Ingredient\Unite;
use App\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\Ingredient::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::BOOLEAN, nullable: true)]
    private bool $estVegetarien;

    /**
     * @var Collection<int, RecetteIngredient>
     */
    #[ORM\OneToMany(targetEntity: RecetteIngredient::class, mappedBy: 'ingredient')]
    private Collection $recetteIngredients;

    public function __construct(
        #[ORM\Column(type: Types::STRING, nullable: false)]
        private string $title,

        #[ORM\Column(nullable: false, enumType: Groupe::class)]
        private Groupe $groupe,

        #[ORM\Column(nullable: true, enumType: Unite::class)]
        private ?Unite $unite = null,

        ?bool $estVegetarien = null,
    ) {
        $this->estVegetarien = $estVegetarien ?? $this->groupe->estVegetarien();

        $this->recetteIngredients = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGroupe(): Groupe
    {
        return $this->groupe;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function estVegetarien(): bool
    {
        return $this->estVegetarien;
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
}
