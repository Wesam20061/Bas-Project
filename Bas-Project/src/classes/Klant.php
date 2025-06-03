<?php
// auteur: Wesam Ali
// functie: definitie class Klant

namespace Bas\classes;

use Bas\classes\Database;
use PDO;
use PDOException;

include_once "functions.php";

class Klant extends Database {
    public $klantId;
    public $klantemail = null;
    public $klantnaam;
    public $klantwoonplaats;
    public $klantadres;
    public $klantpostcode;
    private $table_name = "klant";

    public function crudKlant(): void {
        $lijst = $this->getKlanten();
        $this->showTable($lijst);
    }

    public function getKlanten(): array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name";
        return $conn->query($sql)->fetchAll();
    }

    public function getKlant(int $klantId): array {
        $conn = $this->getConnection();
        $sql = "SELECT * FROM $this->table_name WHERE klantId = :klantId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['klantId' => $klantId]);
        return $stmt->fetch();
    }

    public function dropDownKlant($row_selected = -1): void {
        $lijst = $this->getKlanten();
        echo "<label for='Klant'>Kies een klant:</label>";
        echo "<select name='klantId'>";
        foreach ($lijst as $row) {
            $selected = ($row_selected == $row["klantId"]) ? "selected='selected'" : "";
            echo "<option value='{$row['klantId']}' $selected>{$row['klantNaam']} - {$row['klantEmail']}</option>";
        }
        echo "</select>";
    }

    public function showTable($lijst): void {
        $txt = "<table border='1'>
            <tr>
                <th>Id</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th>
                <th>Wijzig</th><th>Verwijder</th>
            </tr>";
        foreach ($lijst as $row) {
            $txt .= "<tr>
                <td>{$row['klantId']}</td>
                <td>{$row['klantNaam']}</td>
                <td>{$row['klantEmail']}</td>
                <td>{$row['klantAdres']}</td>
                <td>{$row['klantPostcode']}</td>
                <td>{$row['klantWoonplaats']}</td>
                <td>
                    <form method='post' action='update.php?klantId={$row['klantId']}'>
                        <button name='update'>Wzg</button>
                    </form>
                </td>
                <td>
                    <form method='post' action='delete.php?klantId={$row['klantId']}'>
                        <button name='verwijderen'>Verwijderen</button>
                    </form>
                </td>
            </tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    public function deleteKlant(int $klantId): bool {
        $conn = $this->getConnection();
        $sql = "DELETE FROM $this->table_name WHERE klantId = :klantId";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['klantId' => $klantId]);
    }

    public function updateKlant($row): bool {
        $conn = $this->getConnection();
        $sql = "UPDATE $this->table_name 
                SET klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats 
                WHERE klantId = :klantId";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'klantNaam' => $row['klantNaam'],
            'klantEmail' => $row['klantEmail'],
            'klantAdres' => $row['klantAdres'],
            'klantPostcode' => $row['klantPostcode'],
            'klantWoonplaats' => $row['klantWoonplaats'],
            'klantId' => $row['klantId']
        ]);
    }

    private function BepMaxKlantId(): int {
        $conn = $this->getConnection();
        $sql = "SELECT MAX(klantId)+1 FROM $this->table_name";
        return (int) $conn->query($sql)->fetchColumn();
    }

    public function insertKlant(): bool {
        $conn = $this->getConnection();
        $sql = "INSERT INTO $this->table_name 
                (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) 
                VALUES (:klantNaam, :klantEmail, :klantAdres, :klantPostcode, :klantWoonplaats)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'klantNaam' => $this->klantnaam,
            'klantEmail' => $this->klantemail,
            'klantAdres' => $this->klantadres,
            'klantPostcode' => $this->klantpostcode,
            'klantWoonplaats' => $this->klantwoonplaats
        ]);
    }

    // Setters
    public function setKlantNaam($naam): void {
        $this->klantnaam = $naam;
    }

    public function setKlantEmail($email): void {
        $this->klantemail = $email;
    }

    public function setKlantWoonplaats($woonplaats): void {
        $this->klantwoonplaats = $woonplaats;
    }

    public function setKlantAdres($adres): void {
        $this->klantadres = $adres;
    }

    public function setKlantPostcode($postcode): void {
        $this->klantpostcode = $postcode;
    }
}
