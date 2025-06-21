<?php
// auteur: Wesam Ali
// functie: definitie class Artikel

namespace Bas\classes;

use PDO;
use PDOException;

class Artikel extends Database {
    public $artOmschrijving;
    public $artInkoop;
    public $artVerkoop;
    public $artVoorraad;
    public $artMinVoorraad;
    public $artMaxVoorraad;
    public $artLocatie;

    private $table_name = "artikelen";

    public function getArtikelen(): array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name";
        return $conn->query($sql)->fetchAll();
    }

    public function getArtikel(int $artId): array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name WHERE artId = :artId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['artId' => $artId]);
        return $stmt->fetch();
    }

    public function insertArtikel(): bool {
        $conn = $this->getConnection();
        $sql = "INSERT INTO $this->table_name 
            (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
            VALUES
            (:artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $this->artOmschrijving,
            'artInkoop' => $this->artInkoop,
            'artVerkoop' => $this->artVerkoop,
            'artVoorraad' => $this->artVoorraad,
            'artMinVoorraad' => $this->artMinVoorraad,
            'artMaxVoorraad' => $this->artMaxVoorraad,
            'artLocatie' => $this->artLocatie
        ]);
    }

    public function updateArtikel($row): bool {
        $conn = $this->getConnection();
        $sql = "UPDATE $this->table_name SET 
            artOmschrijving = :artOmschrijving,
            artInkoop = :artInkoop,
            artVerkoop = :artVerkoop,
            artVoorraad = :artVoorraad,
            artMinVoorraad = :artMinVoorraad,
            artMaxVoorraad = :artMaxVoorraad,
            artLocatie = :artLocatie
            WHERE artId = :artId";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'artOmschrijving' => $row['artOmschrijving'],
            'artInkoop' => $row['artInkoop'],
            'artVerkoop' => $row['artVerkoop'],
            'artVoorraad' => $row['artVoorraad'],
            'artMinVoorraad' => $row['artMinVoorraad'],
            'artMaxVoorraad' => $row['artMaxVoorraad'],
            'artLocatie' => $row['artLocatie'],
            'artId' => $row['artId']
        ]);
    }

    public function deleteArtikel(int $artId): bool {
        $conn = $this->getConnection();
        $sql = "DELETE FROM $this->table_name WHERE artId = :artId";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['artId' => $artId]);
    }

    public function showTable($lijst): void {
        echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Omschrijving</th>
                <th>Inkoop</th>
                <th>Verkoop</th>
                <th>Voorraad</th>
                <th>Min</th>
                <th>Max</th>
                <th>Locatie</th>
                <th>Update</th>
                <th>Verwijder</th>
            </tr>";
        foreach ($lijst as $row) {
            echo "<tr>
                <td>{$row['artId']}</td>
                <td>{$row['artOmschrijving']}</td>
                <td>{$row['artInkoop']}</td>
                <td>{$row['artVerkoop']}</td>
                <td>{$row['artVoorraad']}</td>
                <td>{$row['artMinVoorraad']}</td>
                <td>{$row['artMaxVoorraad']}</td>
                <td>{$row['artLocatie']}</td>
                <td>
                    <form method='post' action='update.php?artId={$row['artId']}'>
                        <button name='update'>Wzg</button>
                    </form>
                </td>
                <td>
                    <form method='post' action='delete.php?artId={$row['artId']}'>
                        <button name='verwijderen'>Verwijderen</button>
                    </form>
                </td>
            </tr>";
        }
        echo "</table>";
    }

    public function crudArtikel(): void {
        $lijst = $this->getArtikelen();
        $this->showTable($lijst);
    }

    // Setters
    public function setArtOmschrijving($val) { $this->artOmschrijving = $val; }
    public function setArtInkoop($val) { $this->artInkoop = $val; }
    public function setArtVerkoop($val) { $this->artVerkoop = $val; }
    public function setArtVoorraad($val) { $this->artVoorraad = $val; }
    public function setArtMinVoorraad($val) { $this->artMinVoorraad = $val; }
    public function setArtMaxVoorraad($val) { $this->artMaxVoorraad = $val; }
    public function setArtLocatie($val) { $this->artLocatie = $val; }
}
