<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<Entity\Recette>
 */
class Recette extends EntityRepository
{
}
