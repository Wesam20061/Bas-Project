<?php 
// auteur: Wesam Ali
// functie: klant verwijderen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

$klant = new Klant();

// Als gebruiker bevestigt om te verwijderen
if (isset($_POST["verwijderen"]) && isset($_POST["klantId"])) {
    $klantId = $_POST["klantId"];
    $klant->deleteKlant((int)$klantId);

    header("Location: read.php?success=3");
    exit;
}

// Als klantId via GET is meegegeven, toon klantgegevens en vraag bevestiging
if (isset($_GET["klantId"])) {
    $klantId = $_GET["klantId"];
    $row = $klant->getKlant($klantId);

    if ($row) {
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Klant verwijderen</title>
    <link rel="stylesheet" href="../style.css?v=1.0">

</head>
<body>
    <h1>Verwijder klant</h1>
    <p>Weet je zeker dat je deze klant wilt verwijderen?</p>

    <ul>
        <li><strong>Naam:</strong> <?= htmlspecialchars($row['klantNaam']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($row['klantEmail']) ?></li>
        <li><strong>Adres:</strong> <?= htmlspecialchars($row['klantAdres']) ?>, <?= htmlspecialchars($row['klantPostcode']) ?> <?= htmlspecialchars($row['klantWoonplaats']) ?></li>
    </ul>

    <form method="post" action="delete.php">
        <input type="hidden" name="klantId" value="<?= $row['klantId'] ?>">
        <button type="submit" name="verwijderen">✅ Verwijderen</button>
        <a href="read.php">❌ Annuleer</a>
    </form>
</body>
</html>
<?php
    } else {
        echo "❌ Klant niet gevonden.";
    }
} else {
    echo "❌ Geen klantId opgegeven.";
}
?>
