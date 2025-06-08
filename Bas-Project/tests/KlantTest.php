<?php

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

// Vereist dat de database- en klantklassen worden geladen
require_once __DIR__ . '/../src/classes/Database.php';
require_once __DIR__ . '/../src/classes/Klant.php';

class KlantTest extends TestCase
{
    public function testSetKlantNaam()
    {
        $klant = new Klant();
        $klant->setKlantNaam("Test Naam");
        $this->assertSame("Test Naam", $klant->klantnaam);
    }

    public function testSetKlantEmail()
    {
        $klant = new Klant();
        $klant->setKlantEmail("test@example.com");
        $this->assertSame("test@example.com", $klant->klantemail);
    }

    public function testSetKlantAdres()
    {
        $klant = new Klant();
        $klant->setKlantAdres("Straat 123");
        $this->assertSame("Straat 123", $klant->klantadres);
    }

    public function testSetKlantPostcode()
    {
        $klant = new Klant();
        $klant->setKlantPostcode("1234AB");
        $this->assertSame("1234AB", $klant->klantpostcode);
    }

    public function testSetKlantWoonplaats()
    {
        $klant = new Klant();
        $klant->setKlantWoonplaats("Amsterdam");
        $this->assertSame("Amsterdam", $klant->klantwoonplaats);
    }
}
