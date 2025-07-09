<?php
// Bestand: src/artikel/insert.php
require_once __DIR__ . '/../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

if (isset($_POST['insert'])) {
    $artikel->setArtOmschrijving($_POST['artOmschrijving']);
    $artikel->setArtInkoop($_POST['artInkoop']);
    $artikel->setArtVerkoop($_POST['artVerkoop']);
    $artikel->setArtVoorraad($_POST['artVoorraad']);
    $artikel->setArtMinVoorraad($_POST['artMinVoorraad']);
    $artikel->setArtMaxVoorraad($_POST['artMaxVoorraad']);
    $artikel->setArtLocatie($_POST['artLocatie']);

    if ($artikel->insertArtikel()) {
        header("Location: read.php?success=1");
        exit;
    } else {
        echo "<p style='color:red;'>Fout bij invoegen artikel.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head><title>Artikel toevoegen</title></head>
<link rel="stylesheet" href="../style.css?v=1.0">

<body>
<h1>Artikel toevoegen</h1>
<form method="post">
    Omschrijving: <input type="text" name="artOmschrijving" required><br>
    Inkoopprijs: <input type="number" step="0.01" name="artInkoop" required><br>
    Verkoopprijs: <input type="number" step="0.01" name="artVerkoop" required><br>
    Voorraad: <input type="number" name="artVoorraad" required><br>
    Min voorraad: <input type="number" name="artMinVoorraad" required><br>
    Max voorraad: <input type="number" name="artMaxVoorraad" required><br>
    Locatie: <input type="text" name="artLocatie" required><br>
    <input type="submit" name="insert" value="Toevoegen">
</form>
<a href="read.php">Terug</a>
</body>
</html>