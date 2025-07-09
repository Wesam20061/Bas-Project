<?php
// auteur: Wesam Ali
// functie: verkooporder verwijderen

require_once __DIR__ . '/../../vendor/autoload.php';  // ✅ autoload toevoegen

use Bas\classes\Verkooporder;

$order = new Verkooporder();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verkOrdId'])) {
    if ($order->deleteVerkooporder((int)$_POST['verkOrdId'])) {
        header("Location: read.php?success=3");
        exit;
    } else {
        echo "<p style='color:red;'>❌ Verwijderen mislukt.</p>";
    }
}

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
    <title>Verkooporder verwijderen</title>
    <link rel="stylesheet" href="../style.css?v=1.0">


</head>
<body>
<h1>Verkooporder verwijderen</h1>

<p>Weet je zeker dat je deze verkooporder wilt verwijderen?</p>

<ul>
    <li><strong>Klant:</strong> <?= htmlspecialchars($row['klantNaam']) ?></li>
    <li><strong>Artikel:</strong> <?= htmlspecialchars($row['artOmschrijving']) ?></li>
    <li><strong>Datum:</strong> <?= htmlspecialchars($row['verkOrdDatum']) ?></li>
    <li><strong>Aantal:</strong> <?= htmlspecialchars($row['verkOrdBestAantal']) ?></li>
    <li><strong>Status:</strong> <?= htmlspecialchars($row['verkOrdStatus']) ?></li>
</ul>

<form method="post">
    <input type="hidden" name="verkOrdId" value="<?= $row['verkOrdId'] ?>">
    <button type="submit">✅ Verwijderen</button>
    <a href="read.php">❌ Annuleren</a>
</form>
</body>
</html>
