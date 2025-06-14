<?php 
// auteur: Wesam Ali
// functie: klant verwijderen

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Klant;

// Controleer of formulier is verzonden én klantId bestaat
if (isset($_POST["verwijderen"]) && isset($_GET["klantId"])) {
    
    // Maak een object Klant
    $klant = new Klant;

    // Verwijder klant op basis van klantId
    $klantId = $_GET["klantId"];
    $klant->deleteKlant((int)$klantId);

    // ✅ Redirect met succesmelding
    header("Location: read.php?success=3");
    exit;
} else {
    echo "<p style='color: red;'>❌ Geen klantId opgegeven of fout bij verwijderen.</p>";
}
?>
