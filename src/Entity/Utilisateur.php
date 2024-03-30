<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\Utilisateur::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct() {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
