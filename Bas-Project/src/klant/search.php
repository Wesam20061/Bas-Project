<?php
// auteur: Wesam Ali
// functie: zoeken op klantnaam

require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();
$resultaten = [];

if (isset($_POST['zoek']) && !empty($_POST['klantnaam'])) {
    $zoeknaam = $_POST['klantnaam'];
    $alleKlanten = $klant->getKlanten();

    // Zoek op gedeeltelijke overeenkomst (case-insensitive)
    foreach ($alleKlanten as $row) {
        if (stripos($row['klantNaam'], $zoeknaam) !== false) {
            $resultaten[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klant zoeken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Zoek op Klantnaam</h1>

    <form method="post">
        <label>Naam:</label>
        <input type="text" name="klantnaam" required>
        <input type="submit" name="zoek" value="Zoeken">
    </form>

    <br><a href="read.php">Terug naar overzicht</a><br><br>

    <?php if (isset($_POST['zoek'])): ?>
        <h2>Zoekresultaten:</h2>
        <?php if (count($resultaten) > 0): ?>
            <table border="1">
                <tr>
                    <th>ID</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th>
                </tr>
                <?php foreach ($resultaten as $row): ?>
                    <tr>
                        <td><?= $row['klantId'] ?></td>
                        <td><?= $row['klantNaam'] ?></td>
                        <td><?= $row['klantEmail'] ?></td>
                        <td><?= $row['klantAdres'] ?></td>
                        <td><?= $row['klantPostcode'] ?></td>
                        <td><?= $row['klantWoonplaats'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="color: red;">❌ Geen klanten gevonden met deze naam.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
