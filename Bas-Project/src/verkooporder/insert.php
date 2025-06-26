<?php
// auteur: Wesam Ali
// functie: nieuwe verkooporder toevoegen

require_once __DIR__ . '/../../vendor/autoload.php';
use Bas\classes\Verkooporder;

$order = new Verkooporder();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order->setKlantId($_POST['klantId']);
    $order->setDatum($_POST['datum']);
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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Verkooporder toevoegen</h1>
    <form method="post">
        <label>Klant ID: <input type="number" name="klantId" required></label><br>
        <label>Datum: <input type="date" name="datum" required></label><br>
        <label>Status: 
            <select name="status">
                <option value="In behandeling">In behandeling</option>
                <option value="Verzonden">Verzonden</option>
                <option value="Geannuleerd">Geannuleerd</option>
            </select>
        </label><br><br>
        <input type="submit" value="Opslaan">
    </form>
    <br><a href="read.php">Terug</a>
</body>
</html>
