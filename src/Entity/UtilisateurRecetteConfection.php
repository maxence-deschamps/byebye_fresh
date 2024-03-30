<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\UtilisateurRecetteConfection::class)]
class UtilisateurRecetteConfection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: UtilisateurRecette::class, cascade: ['persist', 'remove'], inversedBy: 'confections')]
        private UtilisateurRecette $utilisateurRecette,

        #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
        private DateTimeImmutable $confectionneLe,
    ) {
        $this->utilisateurRecette->ajouterConfection($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUtilisateurRecette(): UtilisateurRecette
    {
        return $this->utilisateurRecette;
    }

    public function getConfectionneLe(): DateTimeImmutable
    {
        return $this->confectionneLe;
    }
}
