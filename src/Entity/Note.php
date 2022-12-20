<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private ?int $numerator = null;


    #[ORM\Column]
    private ?int $denomunator = null;
    

    #[ORM\ManyToOne(targetEntity: Matiere::class, inversedBy: 'Note')]
    private $matiere;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'Note')]
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getNumerator(): ?int
    {
        return $this->numerator;
    }
    public function setNumerator(int $numerator): ?int
    {
        return $this->numerator = $numerator;
    }

    
    public function getDenomunator(): ?int
    {
        return $this->denomunator;
    }

      
    public function setDenomunator(int $denomunator): ?self
    {
         $this->denomunator = $denomunator;
         return $this ; 
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

      
    public function setMatiere(Matiere $matiere): ?self
    {
         $this->matiere = $matiere;
         return $this ; 
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

      
    public function setUser(User $user): ?self
    {
         $this->user = $user;
         return $this ; 
    }
}
