<?php
// auteur: jouw naam
// functie: klant toevoegen via formulier

require '../../vendor/autoload.php';
use Bas\classes\Klant;

$msg = "";

// Als formulier is verzonden
if (isset($_POST["insert"]) && $_POST["insert"] === "Toevoegen") {
    $klant = new Klant();
    $klant->setKlantNaam($_POST['klantnaam'] ?? '');
    $klant->setKlantEmail($_POST['klantemail'] ?? '');
    $klant->setKlantWoonplaats($_POST['klantwoonplaats'] ?? '');
    $klant->setKlantAdres($_POST['klantadres'] ?? '');
    $klant->setKlantPostcode($_POST['klantpostcode'] ?? '');

    if ($klant->insertKlant()) {
        header("Location: read.php?success=1");
        exit;
    } else {
        $msg = "❌ Er is iets misgegaan bij het toevoegen.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Klant Toevoegen</title>
    <link rel="stylesheet" href="../style.css?v=1.0">

</head>
<body>

<h1>Nieuwe klant toevoegen</h1>

<?php if ($msg): ?>
    <p><?= $msg ?></p>
<?php endif; ?>

<form method="post">
    <label for="klantnaam">Naam:</label>
    <input type="text" id="klantnaam" name="klantnaam" required><br>

    <label for="klantemail">Email:</label>
    <input type="email" id="klantemail" name="klantemail" required><br>

    <label for="klantwoonplaats">Woonplaats:</label>
    <input type="text" id="klantwoonplaats" name="klantwoonplaats"><br>

    <label for="klantadres">Adres:</label>
    <input type="text" id="klantadres" name="klantadres"><br>

    <label for="klantpostcode">Postcode:</label>
    <input type="text" id="klantpostcode" name="klantpostcode"><br><br>

    <input type="submit" name="insert" value="Toevoegen">
</form>

<br>
<a href="read.php">🔙 Terug naar overzicht</a>

</body>
</html>
