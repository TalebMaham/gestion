<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Opportunity
{
    


      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="opportunities")
     * @ORM\JoinColumn(nullable=true)
     */
    private $projet;


    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="float")
     */
    private $budget;

    /**
     * @ORM\Column(type="float")
     */
    private $monthlyProfit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): void
    {
        $this->budget = $budget;
    }

    public function getMonthlyProfit(): ?float
    {
        return $this->monthlyProfit;
    }

    public function setMonthlyProfit(float $monthlyProfit): void
    {
        $this->monthlyProfit = $monthlyProfit;
    }

    public function getAnnualProfit(): ?float
    {
        return $this->monthlyProfit * 12;
    }

    public function getProfitPercentage(): ?float
    {
        return ($this->monthlyProfit / $this->budget) * 100;
    }

    

}
