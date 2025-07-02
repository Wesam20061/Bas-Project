<?php
// auteur: Wesam Ali
// functie: overzicht verkooporders tonen

require_once __DIR__ . '/../../vendor/autoload.php';

use Bas\classes\Verkooporder;

$order = new Verkooporder();
$lijst = $order->getVerkooporders();

function vertaalStatus($code) {
    return match((int)$code) {
        1 => "In behandeling",
        2 => "Verzonden",
        3 => "Geannuleerd",
        default => "Onbekend"
    };
}
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

    <?php if (isset($_GET['success'])): ?>
        <?php
            $msg = match ($_GET['success']) {
                '1' => '✅ Verkooporder is succesvol toegevoegd!',
                '2' => '✅ Verkooporder is succesvol gewijzigd!',
                '3' => '🗑️ Verkooporder is succesvol verwijderd!',
                default => null
            };
            if ($msg) echo "<p style='color: green; font-weight: bold;'>$msg</p>";
        ?>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Klant</th>
            <th>Artikel</th>
            <th>Datum</th>
            <th>Aantal</th>
            <th>Status</th>
            <th>Wijzigen</th>
            <th>Verwijderen</th>
        </tr>
        <?php foreach ($lijst as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['verkOrdId']) ?></td>
            <td><?= htmlspecialchars($row['klantNaam']) ?></td>
            <td><?= htmlspecialchars($row['artOmschrijving']) ?></td>
            <td><?= htmlspecialchars($row['verkOrdDatum']) ?></td>
            <td><?= htmlspecialchars($row['verkOrdBestAantal']) ?></td>
            <td><?= htmlspecialchars(vertaalStatus($row['verkOrdStatus'])) ?></td>
            <td>
                <!-- Link naar update.php met verkOrdId -->
                <form method="get" action="update.php">
                    <input type="hidden" name="verkOrdId" value="<?= $row['verkOrdId'] ?>">
                    <button type="submit">✏️ Wijzigen</button>
                </form>
            </td>
            <td>
                <!-- Link naar delete.php met verkOrdId -->
                <form method="get" action="delete.php">
                    <input type="hidden" name="verkOrdId" value="<?= $row['verkOrdId'] ?>">
                    <button type="submit">🗑️ Verwijderen</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

