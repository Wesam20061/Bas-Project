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
        <a href="search.php">Zoek klant</a>

    </nav>

   <?php
// ✅ Laat succesmeldingen zien
if (isset($_GET['success'])) {
    if ($_GET['success'] == 1) {
        echo "<p style='color: green; font-weight: bold;'>✅ Klant is succesvol toegevoegd!</p>";
    } elseif ($_GET['success'] == 2) {
        echo "<p style='color: green; font-weight: bold;'>✅ Klant is succesvol gewijzigd!</p>";
    } elseif ($_GET['success'] == 3) {
        echo "<p style='color: green; font-weight: bold;'>🗑️ Klant is succesvol verwijderd!</p>";
    }
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
