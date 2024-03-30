<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Repository\UtilisateurRecette::class)]
#[ORM\UniqueConstraint(name: 'recette_utilisateur', fields: ['recette', 'utilisateur'])]
class UtilisateurRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    /**
     * @var Collection<int, UtilisateurRecetteConfection>
     */
    #[ORM\OneToMany(targetEntity: UtilisateurRecetteConfection::class, mappedBy: 'utilisateurRecette')]
    private Collection $confections;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Recette::class, cascade: ['persist', 'remove'])]
        private Utilisateur $utilisateur,

        #[ORM\ManyToOne(targetEntity: Recette::class, cascade: ['persist', 'remove'])]
        private Recette $recette,

        #[ORM\Column(type: Types::TEXT, nullable: true)]
        private ?string $note,
    ) {
        $this->confections = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUtilisateur(): Utilisateur
    {
        return $this->utilisateur;
    }

    public function getRecette(): Recette
    {
        return $this->recette;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @return Collection<int, UtilisateurRecetteConfection>
     */
    public function getConfections(): Collection
    {
        return $this->confections;
    }

    public function ajouterConfection(UtilisateurRecetteConfection $confection): void
    {
        if (!$this->confections->contains($confection)) {
            $this->confections->add($confection);
        }
    }
}
