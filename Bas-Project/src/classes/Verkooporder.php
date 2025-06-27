<?php
// auteur: Wesam Ali
// functie: definitie class Verkooporder

namespace Bas\classes;

use PDO;

class Verkooporder extends Database {
    public $klantId;
    public $artId;
    public $verkOrdDatum;
    public $verkOrdBestAantal;
    public $verkOrdStatus;

    private $table_name = "verkooporders";

    public function getVerkooporders(): array {
        $conn = $this->getConnection();
        $sql = "SELECT v.verkOrdId, k.klantNaam, a.artOmschrijving, v.verkOrdDatum, v.verkOrdBestAantal, v.verkOrdStatus
                FROM {$this->table_name} v
                JOIN klant k ON v.klantId = k.klantId
                JOIN artikelen a ON v.artId = a.artId
                ORDER BY v.verkOrdId DESC";
        return $conn->query($sql)->fetchAll();
    }

    public function insertVerkooporder(): bool {
        $conn = $this->getConnection();
        $sql = "INSERT INTO {$this->table_name} (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :verkOrdDatum, :verkOrdBestAantal, :verkOrdStatus)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'klantId' => $this->klantId,
            'artId' => $this->artId,
            'verkOrdDatum' => $this->verkOrdDatum,
            'verkOrdBestAantal' => $this->verkOrdBestAantal,
            'verkOrdStatus' => $this->verkOrdStatus
        ]);
    }

    // Correcte Setters
    public function setKlantId($val) { $this->klantId = $val; }
    public function setArtId($val) { $this->artId = $val; }
    public function setDatum($val) { $this->verkOrdDatum = $val; }
    public function setAantal($val) { $this->verkOrdBestAantal = $val; }
    public function setStatus($val) { $this->verkOrdStatus = $val; }
}
