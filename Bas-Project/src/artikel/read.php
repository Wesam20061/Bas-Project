<?php
// Bestand: src/artikel/read.php
// Auteur: Wesam Ali

require_once __DIR__ . '/../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();
$lijst = $artikel->getArtikelen();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>CRUD Artikel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>CRUD Artikel</h1>

    <nav>
        <a href='../../index.html'> Home</a><br>
        <a href='insert.php'> Nieuw artikel toevoegen</a><br><br>
    </nav>

    <?php
    // ✅ Succesmeldingen
    if (isset($_GET['success'])) {
        if ($_GET['success'] == 1) {
            echo "<p style='color: green; font-weight: bold;'>✅ Artikel is succesvol toegevoegd!</p>";
        } elseif ($_GET['success'] == 2) {
            echo "<p style='color: green; font-weight: bold;'>✅ Artikel is succesvol gewijzigd!</p>";
        } elseif ($_GET['success'] == 3) {
            echo "<p style='color: green; font-weight: bold;'>🗑️ Artikel is succesvol verwijderd!</p>";
        }
    }

    // ✅ Tabel met alle artikelgegevens
    echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Omschrijving</th>
            <th>Inkoopprijs</th>
            <th>Verkoopprijs</th>
            <th>Voorraad</th>
            <th>Min voorraad</th>
            <th>Max voorraad</th>
            <th>Locatie</th>
            <th>Wijzigen</th>
            <th>Verwijderen</th>
        </tr>";

    foreach ($lijst as $row) {
        echo "<tr>
            <td>" . htmlspecialchars($row['artId']) . "</td>
            <td>" . htmlspecialchars($row['artOmschrijving']) . "</td>
            <td>€ " . htmlspecialchars($row['artInkoop']) . "</td>
            <td>€ " . htmlspecialchars($row['artVerkoop']) . "</td>
            <td>" . htmlspecialchars($row['artVoorraad']) . "</td>
            <td>" . htmlspecialchars($row['artMinVoorraad']) . "</td>
            <td>" . htmlspecialchars($row['artMaxVoorraad']) . "</td>
            <td>" . htmlspecialchars($row['artLocatie']) . "</td>
            <td>
                <form method='get' action='update.php'>
                    <input type='hidden' name='artId' value='{$row['artId']}'>
                    <button type='submit' name='update'>Wijzigen</button>
                </form>
            </td>
            <td>
                <form method='get' action='delete.php'>
                    <input type='hidden' name='artId' value='{$row['artId']}'>
                    <button type='submit' name='verwijderen'>Verwijderen</button>
                </form>
            </td>
        </tr>";
    }

    echo "</table>";
    ?>
</body>
</html>
