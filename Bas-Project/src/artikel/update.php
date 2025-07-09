
<?php
// Bestand: src/artikel/update.php
require_once __DIR__ . '/../../vendor/autoload.php';
use Bas\classes\Artikel;

$artikel = new Artikel();

if (isset($_POST['update'])) {
    $artikel->updateArtikel($_POST);
    header("Location: read.php?success=2");
    exit;
}

if (isset($_GET['artId'])) {
    $row = $artikel->getArtikel((int)$_GET['artId']);
} else {
    die("Geen artikel opgegeven.");
}
?>
<!DOCTYPE html>
<html>
<head><title>Artikel wijzigen</title></head>
<link rel="stylesheet" href="../style.css?v=1.0">
<body>
<h1>Artikel wijzigen</h1>
<form method="post">
    <input type="hidden" name="artId" value="<?= $row['artId'] ?>">
    Omschrijving: <input type="text" name="artOmschrijving" value="<?= $row['artOmschrijving'] ?>" required><br>
    Inkoopprijs: <input type="number" step="0.01" name="artInkoop" value="<?= $row['artInkoop'] ?>" required><br>
    Verkoopprijs: <input type="number" step="0.01" name="artVerkoop" value="<?= $row['artVerkoop'] ?>" required><br>
    Voorraad: <input type="number" name="artVoorraad" value="<?= $row['artVoorraad'] ?>" required><br>
    Min voorraad: <input type="number" name="artMinVoorraad" value="<?= $row['artMinVoorraad'] ?>" required><br>
    Max voorraad: <input type="number" name="artMaxVoorraad" value="<?= $row['artMaxVoorraad'] ?>" required><br>
    Locatie: <input type="text" name="artLocatie" value="<?= $row['artLocatie'] ?>" required><br>
    <input type="submit" name="update" value="Wijzigen">
</form>
<a href="read.php">Terug</a>
</body>
</html>
