<?php

use App\Entity\Matiere;
use App\Entity\Note;
use App\Entity\User;
use PHPUnit\Framework\TestCase ;

class NoteUnitTest extends TestCase
{

    public function testSetNumerator(): void
    {
        $votreObjet = new Note(); 
        $resultat = $votreObjet->setNumerator(10);
        $this->assertEquals(10, $resultat);
        $this->assertEquals(10, $votreObjet->getNumerator());
    }

    public function testSetDenominator(): void
    {
        $votreObjet = new Note();         
        $resultat = $votreObjet->setDenominator(5);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals(5, $votreObjet->getDenominator());
    }

    public function testSetMatiere(): void
    {
        $votreObjet = new Note(); 
        $matiere = new Matiere(); 
        $resultat = $votreObjet->setMatiere($matiere);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($matiere, $votreObjet->getMatiere());
    }

    public function testSetUser(): void
    {
        $votreObjet = new Note(); 
        $user = new User(); 
        $resultat = $votreObjet->setUser($user);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($user, $votreObjet->getUser());
    }

    public function testSetPresent(): void
    {
        $votreObjet = new User(); 
        $present = true; 
        $resultat = $votreObjet->setPresent($present);
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals($present, $votreObjet->isPresent());
    }



}
