<?php 
// auteur: Wesam Ali
// functie: artikel verwijderen

require '../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

// Als gebruiker bevestigt om te verwijderen
if (isset($_POST["verwijderen"]) && isset($_POST["artId"])) {
    $artId = $_POST["artId"];
    $artikel->deleteArtikel((int)$artId);

    header("Location: read.php?success=3");
    exit;
}

// Als artId via GET is meegegeven, toon artikelgegevens en vraag bevestiging
if (isset($_GET["artId"])) {
    $artId = $_GET["artId"];
    $row = $artikel->getArtikel($artId);

    if ($row) {
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Artikel verwijderen</title>
    <link rel="stylesheet" href="../style.css?v=1.0">

</head>
<body>
    <h1>Verwijder artikel</h1>
    <p>Weet je zeker dat je dit artikel wilt verwijderen?</p>

    <ul>
        <li><strong>Omschrijving:</strong> <?= htmlspecialchars($row['artOmschrijving']) ?></li>
        <li><strong>Prijs:</strong> €<?= htmlspecialchars($row['artVerkoop']) ?></li>
        <li><strong>Voorraad:</strong> <?= htmlspecialchars($row['artVoorraad']) ?></li>
    </ul>

    <form method="post" action="delete.php">
        <input type="hidden" name="artId" value="<?= $row['artId'] ?>">
        <button type="submit" name="verwijderen">✅ Verwijderen</button>
        <a href="read.php">❌ Annuleer</a>
    </form>
</body>
</html>
<?php
    } else {
        echo "❌ Artikel niet gevonden.";
    }
} else {
    echo "❌ Geen artikelId opgegeven.";
}
?>
