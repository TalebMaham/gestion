<?php
namespace App\Tests\E2E;
use Symfony\Component\Panther\PantherTestCase;
class FirstPantherTest extends PantherTestCase
{


    public function testPantherWithAdmin()
    {
        $client = static::createPantherClient([
            'browser' => static::CHROME,
        ], [
            'environment' => 'test'
        ], [
            'connection_timeout_in_ms' => 60000,
            'request_timeout_in_ms' => 120000
        ]);

        $crawler = $client->request('GET', '/prof/eleves');
        $client->executeScript('document.querySelector("#add-note").click()');
        $client->executeScript('document.querySelector("#close-modal-note").click()');

        sleep(3);

    
    }


    public function testPantherWithAdmin2()
    {
        $client = static::createPantherClient([
            'browser' => static::CHROME,
        ], [
            'environment' => 'test'
        ], [
            'connection_timeout_in_ms' => 60000,
            'request_timeout_in_ms' => 120000
        ]);

        $crawler = $client->request('GET', '/prof/eleves');
        $client->executeScript('document.querySelector("#add-note").click()');
        sleep(3);
        $client->executeScript('document.querySelector("#close-modal-note").click()');

        sleep(3);
        $client->executeScript('document.querySelector("#close-modal-note").click()');


        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_1").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_2").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_3").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_4").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_5").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_6").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_1").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_2").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_3").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_4").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_5").click()');
        sleep(1);
        $client->executeScript('document.querySelector("#mbutton_6").click()');
        
        sleep(3);
    }

}