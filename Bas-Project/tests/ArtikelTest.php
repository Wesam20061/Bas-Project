<?php
// Auteur: Wesam Ali
// Bestand: tests/ArtikelTest.php

use PHPUnit\Framework\TestCase;
use Bas\classes\Artikel;

require_once __DIR__ . '/../vendor/autoload.php';

class ArtikelTest extends TestCase
{
    private Artikel $artikel;

    protected function setUp(): void
    {
        $this->artikel = new Artikel();
    }

    public function testInsertArtikel()
    {
        $this->artikel->setArtOmschrijving('Test Artikel');
        $this->artikel->setArtInkoop(10.5);
        $this->artikel->setArtVerkoop(15.99);
        $this->artikel->setArtVoorraad(100);
        $this->artikel->setArtMinVoorraad(10);
        $this->artikel->setArtMaxVoorraad(500);
        $this->artikel->setArtLocatie('TestLocatie');

        $result = $this->artikel->insertArtikel();
        $this->assertTrue($result);
    }

    public function testGetArtikelen()
    {
        $artikelen = $this->artikel->getArtikelen();
        $this->assertIsArray($artikelen);
        $this->assertNotEmpty($artikelen);
    }

    public function testUpdateArtikel()
    {
        $artikelen = $this->artikel->getArtikelen();
        $laatsteArtikel = end($artikelen);

        $laatsteArtikel['artOmschrijving'] = 'Aangepast Artikel';
        $result = $this->artikel->updateArtikel($laatsteArtikel);
        $this->assertTrue($result);
    }

    public function testDeleteArtikel()
    {
        $artikelen = $this->artikel->getArtikelen();
        $laatsteArtikel = end($artikelen);
        $result = $this->artikel->deleteArtikel($laatsteArtikel['artId']);
        $this->assertTrue($result);
    }
}
