<?php

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

class KlantTest extends TestCase
{
    public function testSetAndGetKlantNaam()
    {
        $klant = new Klant();
        $klant->setKlantNaam("Piet");
        $this->assertEquals("Piet", $klant->klantnaam);
    }

    public function testSetAndGetKlantEmail()
    {
        $klant = new Klant();
        $klant->setKlantEmail("piet@example.com");
        $this->assertEquals("piet@example.com", $klant->klantemail);
    }

    public function testSetAndGetKlantWoonplaats()
    {
        $klant = new Klant();
        $klant->setKlantWoonplaats("Rotterdam");
        $this->assertEquals("Rotterdam", $klant->klantwoonplaats);
    }

    public function testInsertKlantReturnsTrue()
    {
        $klant = new Klant();
        $klant->setKlantNaam("Unit Test");
        $klant->setKlantEmail("unittest@example.com");
        $klant->setKlantWoonplaats("Utrecht");

        $this->assertTrue($klant->insertKlant(), "insertKlant() moet true teruggeven bij succesvolle insert");
    }
}
