<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;    
        
class StudentsControllerTest extends WebTestCase
{ 
    public function testDataAcquisitionFirstAgent()
        {
           $client = static::createClient();
        
           $crawler = $client->request('GET', '/prof/eleves');
           $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

           $this->assertStringContainsString(
            'sidi@gmail.com',
            $client->getResponse()->getContent()
            );
        
            $this->assertStringContainsString(
                'yahya@gmail.com',
                $client->getResponse()->getContent()
            );    
            $this->assertStringContainsString(
                'khaled@gmail.com',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Mathématiques',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Sciences Naturelles',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Lundi',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Mardi',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Mercredi',
                $client->getResponse()->getContent()
            );
            $this->assertStringContainsString(
                'Jeudi',
                $client->getResponse()->getContent()
            );

            $this->assertStringContainsString(
                'Vendredi',
                $client->getResponse()->getContent()
            );
            $this->assertStringNotContainsString(
                'Samedi',
                $client->getResponse()->getContent()
            );
            $this->assertStringNotContainsString(
                'Dimanche',
                $client->getResponse()->getContent()
            );
        
            $this->assertCount(7, $crawler->filter('#eleve'));


        } 
}
