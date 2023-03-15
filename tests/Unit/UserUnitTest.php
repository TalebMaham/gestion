<?php

use App\Entity\User;
use PHPUnit\Framework\TestCase ;

class UserUnitTest extends TestCase
{

    public function testSetEmail(): void
    {
        $votreObjet = new User(); 
        $email = 'test@example.com'; 
        $resultat = $votreObjet->setEmail($email);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($email, $votreObjet->getEmail());
    }
    public function testSetNom(): void
    {
        $votreObjet = new User(); 
        $nom = 'John Doe'; 
        $resultat = $votreObjet->setNom($nom);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($nom, $votreObjet->getNom());
    }

    public function testSetPrenom(): void
    {
        $votreObjet = new User(); 
        $prenom = 'Jane'; 
        $resultat = $votreObjet->setPrenom($prenom);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($prenom, $votreObjet->getPrenom());
    }
}
