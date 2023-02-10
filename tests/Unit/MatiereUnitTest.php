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

    }
}
