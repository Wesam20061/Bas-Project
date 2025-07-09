<?php
// auteur: Wesam Ali
// functie: nieuwe verkooporder toevoegen

require_once __DIR__ . '/../../vendor/autoload.php';

use Bas\classes\Verkooporder;
use Bas\classes\Klant;
use Bas\classes\Artikel;

$order = new Verkooporder();
$klant = new Klant();
$artikel = new Artikel();

$klanten = $klant->getKlanten();
$artikelen = $artikel->getArtikelen();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order->setKlantId($_POST['klantId']);
    $order->setArtId($_POST['artId']);
    $order->setDatum($_POST['datum']);
    $order->setAantal($_POST['aantal']);
    $order->setStatus($_POST['status']);

    if ($order->insertVerkooporder()) {
        header("Location: read.php?success=1");
        exit;
    } else {
        echo "<p style='color: red;'>❌ Toevoegen mislukt.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe verkooporder</title>
    <link rel="stylesheet" href="../style.css?v=1.0">

</head>
<body>
<h1>Verkooporder toevoegen</h1>

<form method="post">
    <label>Klant:
        <select name="klantId" required>
            <option value="">-- Selecteer klant --</option>
            <?php foreach ($klanten as $k): ?>
                <option value="<?= $k['klantId'] ?>"><?= htmlspecialchars($k['klantNaam']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Artikel:
        <select name="artId" required>
            <option value="">-- Selecteer artikel --</option>
            <?php foreach ($artikelen as $a): ?>
                <option value="<?= $a['artId'] ?>"><?= htmlspecialchars($a['artOmschrijving']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Datum:
        <input type="date" name="datum" required>
    </label><br><br>

    <label>Aantal:
        <input type="number" name="aantal" min="1" required>
    </label><br><br>

    <label>Status:
        <select name="status" required>
            <option value="1">In behandeling</option>
            <option value="2">Verzonden</option>
            <option value="3">Geannuleerd</option>
        </select>
    </label><br><br>

    <input type="submit" value="✅ Opslaan">
</form>

<br><a href="read.php">🔙 Terug</a>
</body>
</html>
