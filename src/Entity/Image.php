<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q1 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q3 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q4 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q5 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q6 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q7 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q8 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q9 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q10 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q11 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q12 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q13 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q14 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $q15 = null;

    #[ORM\Column(nullable: true)]
    private ?int $flage = null;

    #[ORM\OneToOne(inversedBy: 'image', cascade: ['persist', 'remove'])]
    private ?Membre $membre = null;

    #[ORM\OneToOne(mappedBy: 'image', cascade: ['persist', 'remove'])]
    private ?Fonctionnement $fonctionnement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isQ1(): ?bool
    {
        return $this->q1;
    }

    public function setQ1(?bool $q1): static
    {
        $this->q1 = $q1;

        return $this;
    }

    public function isQ2(): ?bool
    {
        return $this->q2;
    }

    public function setQ2(?bool $q2): static
    {
        $this->q2 = $q2;

        return $this;
    }

    public function isQ3(): ?bool
    {
        return $this->q3;
    }

    public function setQ3(?bool $q3): static
    {
        $this->q3 = $q3;

        return $this;
    }

    public function isQ4(): ?bool
    {
        return $this->q4;
    }

    public function setQ4(?bool $q4): static
    {
        $this->q4 = $q4;

        return $this;
    }

    public function isQ5(): ?bool
    {
        return $this->q5;
    }

    public function setQ5(?bool $q5): static
    {
        $this->q5 = $q5;

        return $this;
    }

    public function isQ6(): ?bool
    {
        return $this->q6;
    }

    public function setQ6(?bool $q6): static
    {
        $this->q6 = $q6;

        return $this;
    }

    public function isQ7(): ?bool
    {
        return $this->q7;
    }

    public function setQ7(?bool $q7): static
    {
        $this->q7 = $q7;

        return $this;
    }

    public function isQ8(): ?bool
    {
        return $this->q8;
    }

    public function setQ8(?bool $q8): static
    {
        $this->q8 = $q8;

        return $this;
    }

    public function isQ9(): ?bool
    {
        return $this->q9;
    }

    public function setQ9(?bool $q9): static
    {
        $this->q9 = $q9;

        return $this;
    }

    public function isQ10(): ?bool
    {
        return $this->q10;
    }

    public function setQ10(?bool $q10): static
    {
        $this->q10 = $q10;

        return $this;
    }

    public function isQ11(): ?bool
    {
        return $this->q11;
    }

    public function setQ11(?bool $q11): static
    {
        $this->q11 = $q11;

        return $this;
    }

    public function isQ12(): ?bool
    {
        return $this->q12;
    }

    public function setQ12(?bool $q12): static
    {
        $this->q12 = $q12;

        return $this;
    }

    public function isQ13(): ?bool
    {
        return $this->q13;
    }

    public function setQ13(?bool $q13): static
    {
        $this->q13 = $q13;

        return $this;
    }

    public function isQ14(): ?bool
    {
        return $this->q14;
    }

    public function setQ14(?bool $q14): static
    {
        $this->q14 = $q14;

        return $this;
    }

    public function isQ15(): ?bool
    {
        return $this->q15;
    }

    public function setQ15(?bool $q15): static
    {
        $this->q15 = $q15;

        return $this;
    }

    public function getFlage(): ?int
    {
        return $this->flage;
    }

    public function setFlage(?int $flage): static
    {
        $this->flage = $flage;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getFonctionnement(): ?Fonctionnement
    {
        return $this->fonctionnement;
    }

    public function setFonctionnement(?Fonctionnement $fonctionnement): static
    {
        // unset the owning side of the relation if necessary
        if ($fonctionnement === null && $this->fonctionnement !== null) {
            $this->fonctionnement->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($fonctionnement !== null && $fonctionnement->getImage() !== $this) {
            $fonctionnement->setImage($this);
        }

        $this->fonctionnement = $fonctionnement;

        return $this;
    }
}
