<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\RecetteIngredient::class)]
#[ORM\UniqueConstraint(name: 'recette_ingredient', fields: ['recette', 'ingredient'])]
class RecetteIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Recette::class, cascade: ['persist', 'remove'], inversedBy: 'recetteIngredients')]
        private Recette $recette,

        #[ORM\ManyToOne(targetEntity: Ingredient::class, cascade: ['persist', 'remove'], inversedBy: 'recetteIngredients')]
        private Ingredient $ingredient,

        #[ORM\Column(type: Types::INTEGER, nullable: false)]
        private int $quantite,

        #[ORM\Column(nullable: true, enumType: Ingredient\Unite::class)]
        private ?Ingredient\Unite $unite = null,
    ) {
        $this->recette->ajouterRecetteIngredient($this);
        $this->ingredient->ajouterRecetteIngredient($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecette(): Recette
    {
        return $this->recette;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getUnite(): ?Ingredient\Unite
    {
        return $this->unite;
    }
}
