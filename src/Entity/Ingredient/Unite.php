<?php

declare(strict_types=1);

namespace App\Entity\Ingredient;

enum Unite: string
{
    case LITRE = 'litre';
    case GRAMME = 'gramme';
    case CUILLERE_A_CAFE = 'cuillere_a_cafe';
    case CUILLERE_A_SOUPE = 'cuillere_a_soupe';
}
