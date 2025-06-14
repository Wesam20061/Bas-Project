<?php
// auteur: Wesam Ali
// functie: update class Klant

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant;

if (isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
    // Gegevens uit het formulier ophalen
    $row = [
        'klantId' => $_POST['klantId'],
        'klantNaam' => $_POST['klantnaam'],
        'klantEmail' => $_POST['klantemail'],
        'klantAdres' => $_POST['klantadres'],
        'klantPostcode' => $_POST['klantpostcode'],
        'klantWoonplaats' => $_POST['klantwoonplaats']
    ];

    // Update uitvoeren
    if ($klant->updateKlant($row)) {
        // ✅ Doorverwijzen naar read.php met succesmelding
        header("Location: read.php?success=2");
        exit;
    } else {
        echo "<p style='color: red;'>❌ Wijzigen mislukt.</p>";
    }
}

// Ophalen van bestaande klantgegevens
if (isset($_GET['klantId'])) {
    $row = $klant->getKlant($_GET['klantId']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Wijzigen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>	

<form method="post">
    <input type="hidden" name="klantId" value="<?php echo $row['klantId']; ?>">

    Naam:<br>
    <input type="text" name="klantnaam" required value="<?php echo $row['klantNaam']; ?>"><br><br>

    Email:<br>
    <input type="email" name="klantemail" required value="<?php echo $row['klantEmail']; ?>"><br><br>

    Adres:<br>
    <input type="text" name="klantadres" required value="<?php echo $row['klantAdres']; ?>"><br><br>

    Postcode:<br>
    <input type="text" name="klantpostcode" required value="<?php echo $row['klantPostcode']; ?>"><br><br>

    Woonplaats:<br>
    <input type="text" name="klantwoonplaats" required value="<?php echo $row['klantWoonplaats']; ?>"><br><br>

    <input type="submit" name="update" value="Wijzigen">
</form><br>

<a href="read.php">Terug</a>

</body>
</html>

<?php
} else {
    echo "❌ Geen klantId opgegeven<br>";
}
?>
