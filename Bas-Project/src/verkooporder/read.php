<?php
// auteur: Wesam Ali
// functie: overzicht verkooporders tonen

require_once __DIR__ . '/../../vendor/autoload.php';
use Bas\classes\Verkooporder;

$order = new Verkooporder();
$lijst = $order->getVerkooporders();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Verkooporders</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Verkooporders overzicht</h1>
    <nav>
        <a href="../index.html">🏠 Home</a><br>
        <a href="insert.php">➕ Nieuwe verkooporder toevoegen</a><br><br>
    </nav>

    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Klant</th>
            <th>Artikel</th>
            <th>Datum</th>
            <th>Aantal</th>
            <th>Status</th>
        </tr>
        <?php foreach ($lijst as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['verkOrdId']) ?></td>
            <td><?= htmlspecialchars($row['klantNaam']) ?></td>
            <td><?= htmlspecialchars($row['artOmschrijving']) ?></td>
            <td><?= htmlspecialchars($row['verkOrdDatum']) ?></td>
            <td><?= htmlspecialchars($row['verkOrdBestAantal']) ?></td>
            <td><?= htmlspecialchars($row['verkOrdStatus']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
