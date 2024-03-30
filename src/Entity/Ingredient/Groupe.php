<?php

declare(strict_types=1);

namespace App\Entity\Ingredient;

enum Groupe: string
{
    case BOISSON = 'boisson';
    case CEREALE = 'cereale';
    case FRUIT_OU_LEGUME = 'fruit_ou_legume';
    case PRODUIT_LAITIER = 'produit_laitier';
    case VIANDE_POISSON_OU_OEUF = 'viande_poisson_ou_oeuf';
    case MATIERE_GRASSE = 'matiere_grasse';
    case PRODUIT_SUCRE = 'produit_sucre';
    case ASSAISONNEMENT = 'assaisonnement';

    public function estVegetarien(): bool
    {
        return $this !== self::VIANDE_POISSON_OU_OEUF;
    }
}
