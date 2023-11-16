<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Projet
{

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Opportunity", mappedBy="projet")
     */
    private $opportunities;

    public function __construct()
    {
        $this->opportunities = new ArrayCollection();
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOpportunities(): Collection
    {
        return $this->opportunities;
    }

    public function addOpportunity(Opportunity $opportunity): self
{
    if (!$this->opportunities->contains($opportunity)) {
        $this->opportunities[] = $opportunity;
        $opportunity->setProjet($this);
    }

    return $this;
}

public function removeOpportunity(Opportunity $opportunity): self
{
    if ($this->opportunities->removeElement($opportunity)) {
        // set the owning side to null (unless already changed)
        if ($opportunity->getProjet() === $this) {
            $opportunity->setProjet(null);
        }
    }

    return $this;
}
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $budgetMax;

    /**
     * @ORM\Column(type="float")
     */
    private $budgetMin;

    /**
     * @ORM\Column(type="float")
     */
    private $pourcentageRentabilite;

    /**
     * @ORM\Column(type="json")
     */
    private $villes = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getBudgetMax(): ?float
    {
        return $this->budgetMax;
    }

    public function setBudgetMax(float $budgetMax): void
    {
        $this->budgetMax = $budgetMax;
    }

    public function getBudgetMin(): ?float
    {
        return $this->budgetMin;
    }

    public function setBudgetMin(float $budgetMin): void
    {
        $this->budgetMin = $budgetMin;
    }

    public function getPourcentageRentabilite(): ?float
    {
        return $this->pourcentageRentabilite;
    }

    public function setPourcentageRentabilite(float $pourcentageRentabilite): void
    {
        $this->pourcentageRentabilite = $pourcentageRentabilite;
    }

    public function getVilles(): array
    {
        return $this->villes;
    }

    public function setVilles(array $villes): void
    {
        $this->villes = $villes;
    }
}
