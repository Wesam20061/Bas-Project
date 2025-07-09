<?php
// auteur: Wesam Ali
// functie: verkooporder bijwerken

require_once __DIR__ . '/../../vendor/autoload.php';

use Bas\classes\Verkooporder;
use Bas\classes\Klant;
use Bas\classes\Artikel;

$order = new Verkooporder();
$klant = new Klant();
$artikel = new Artikel();

$klanten = $klant->getKlanten();
$artikelen = $artikel->getArtikelen();

// ✅ Bijwerken na formulierverzending
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'])) {
    $data = [
        'verkOrdId' => $_POST['verkOrdId'],
        'klantId' => $_POST['klantId'],
        'artId' => $_POST['artId'],
        'verkOrdDatum' => $_POST['datum'],
        'verkOrdBestAantal' => $_POST['aantal'],
        'verkOrdStatus' => $_POST['status']
    ];

    if ($order->updateVerkooporder($data)) {
        header("Location: read.php?success=2");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Bijwerken mislukt.</p>";
    }
}

// ✅ Ophalen van gegevens voor het formulier
if (isset($_GET['verkOrdId'])) {
    $row = $order->getVerkooporder((int)$_GET['verkOrdId']);

    if (!$row) {
        die("❌ Verkooporder niet gevonden.");
    }
} else {
    die("❌ Geen verkooporder-ID opgegeven.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporder wijzigen</title>
    <link rel="stylesheet" href="../style.css?v=1.0">

</head>
<body>
<h1>Verkooporder wijzigen</h1>

<form method="post">
    <input type="hidden" name="verkOrdId" value="<?= $row['verkOrdId'] ?>">

    <label>Klant:
        <select name="klantId" required>
            <?php foreach ($klanten as $k): ?>
                <option value="<?= $k['klantId'] ?>" <?= $k['klantId'] == $row['klantId'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($k['klantNaam']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Artikel:
        <select name="artId" required>
            <?php foreach ($artikelen as $a): ?>
                <option value="<?= $a['artId'] ?>" <?= $a['artId'] == $row['artId'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['artOmschrijving']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>

    <label>Datum:
        <input type="date" name="datum" value="<?= $row['verkOrdDatum'] ?>" required>
    </label><br><br>

    <label>Aantal:
        <input type="number" name="aantal" value="<?= $row['verkOrdBestAantal'] ?>" required>
    </label><br><br>

    <label>Status:
        <select name="status" required>
            <option value="1" <?= $row['verkOrdStatus'] == 1 ? 'selected' : '' ?>>In behandeling</option>
            <option value="2" <?= $row['verkOrdStatus'] == 2 ? 'selected' : '' ?>>Verzonden</option>
            <option value="3" <?= $row['verkOrdStatus'] == 3 ? 'selected' : '' ?>>Geannuleerd</option>
        </select>
    </label><br><br>

    <input type="submit" value="✅ Wijzigen">
</form>

<br><a href="read.php">🔙 Terug</a>
</body>
</html>
