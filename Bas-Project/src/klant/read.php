<!--
    Auteur: Wesam Ali
    Functie: CRUD Klant overzichtspagina
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>CRUD Klant</h1>

    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
    </nav>

    <?php
    // ✅ Laat succesmelding zien na toevoegen
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p style='color: green; font-weight: bold;'>✅ Klant is succesvol toegevoegd!</p>";
    }
    ?>

    <?php
    // ✅ Composer autoloader laden
    require_once __DIR__ . '/../../vendor/autoload.php';

    use Bas\classes\Klant;

    // ✅ Object aanmaken en CRUD tonen
    $klant = new Klant();
    $klant->crudKlant();
    ?>
</body>
</html>
