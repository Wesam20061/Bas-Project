<?php
// tests/KlantTest.php

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

require_once __DIR__ . '/../src/classes/Klant.php';
require_once __DIR__ . '/../src/classes/Database.php';

class KlantTest extends TestCase
{
    private Klant $klant;

    protected function setUp(): void
    {
        $this->klant = new Klant();

        // Dummy testgegevens instellen
        $this->klant->setKlantNaam('Test Naam');
        $this->klant->setKlantEmail('test@example.com');
        $this->klant->setKlantAdres('Teststraat 1');
        $this->klant->setKlantPostcode('1234AB');
        $this->klant->setKlantWoonplaats('Teststad');
    }

    public function testInsertKlant(): void
    {
        $result = $this->klant->insertKlant();
        $this->assertTrue($result, "InsertKlant zou true moeten retourneren");
    }

    public function testGetKlanten(): void
    {
        $klanten = $this->klant->getKlanten();
        $this->assertIsArray($klanten);
        $this->assertNotEmpty($klanten);
    }

    public function testGetKlantById(): void
    {
        $laatsteKlant = $this->klant->getKlanten();
        $laatsteId = end($laatsteKlant)['klantId'];

        $klant = $this->klant->getKlant($laatsteId);
        $this->assertIsArray($klant);
        $this->assertEquals('Test Naam', $klant['klantNaam']);
    }

    public function testDeleteKlant(): void
    {
        $laatsteKlant = $this->klant->getKlanten();
        $laatsteId = end($laatsteKlant)['klantId'];

        $result = $this->klant->deleteKlant($laatsteId);
        $this->assertTrue($result, "deleteKlant moet true retourneren");
    }
}
