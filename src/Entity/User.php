<?php

namespace App\Entity;

use App\Repository\UserRepository;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

   


     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="user")
     */
    private $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    // ... autres méthodes et getters/setters

    public function getProjets(): Collection
    {
        return $this->projets;
    }


    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setUser($this);
        }
    
        return $this;
    }
    
    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getUser() === $this) {
                $projet->setUser(null);
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
     * @ORM\Column(length=255)
     * @var string|null
     */
    private ?string $nom = null;

    /**
     * @ORM\Column(length=255)
     * @var string|null
     */
    private ?string $prenom = null;

    /**
     * @ORM\Column(length=180, unique=true)
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @ORM\Column()
     * @var array
     */
    private array $roles = [];

    /**
     * @ORM\Column()
     * @var string|null The hashed password
     */
    private ?string $password = null;

    /**
     * @var bool|null
     */
    private ?bool $present = true;

    /**
     * @ORM\Column()
     * @var string|null
     */
    private ?string $status = "beginner";
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom ;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


    public function getPrenom(): ?string
    {
        return $this->prenom ;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function isPresent(): bool
    {
        return $this->present; 
    }

    public function setPresent(bool $present):self
    {
         $this->present = $present; 

         return $this; 
    }

    public function getStatus(): string
    {
        return $this->status; 
    }

    public function setStatus(string $status):self
    {
         $this->status = $status; 

         return $this; 
    }
}
