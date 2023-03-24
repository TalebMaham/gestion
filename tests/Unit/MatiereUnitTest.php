<?php

use App\Entity\Matiere;
use PHPUnit\Framework\TestCase ;

use function PHPUnit\Framework\assertEquals;

class MatiereUnitTest extends TestCase
{


    public function testMatiereEntity()
    {
        $matiere = new Matiere(); 
        $matiere->setNom("maths"); 
        $matiere->setCoefficient(9); 

        assertEquals($matiere->getNom(), "maths");
        assertEquals($matiere->getCoefficient(), 9);


        $matiere = new Matiere(); 
        $matiere->setNom("physiques"); 
        $matiere->setCoefficient(8); 

        assertEquals($matiere->getNom(), "physiques");
        assertEquals($matiere->getCoefficient(), 8);

    }

    public function testSetNom(): void
    {
        $votreObjet = new Matiere(); 
        $resultat = $votreObjet->setNom('John Doe');
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals('John Doe', $votreObjet->getNom());
    }


    public function testSetCoefficient(): void
    {
        $votreObjet = new Matiere(); 
        $resultat = $votreObjet->setCoefficient('10');
        $this->assertEquals($votreObjet, $resultat);
        $this->assertEquals('10', $votreObjet->getCoefficient());
    }
}
