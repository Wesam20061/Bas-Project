<?php
// auteur: studentnaam
// functie: definitie class Database
namespace Bas\classes;

use PDO;
use PDOException;

// Configuratie laden
require_once __DIR__ . '/config.php';

class Database {
    // Connectie wordt opgeslagen als statische eigenschap
    protected static $conn = null;

    private $servername = SERVERNAME;
    private $username = USERNAME;
    private $password = PASSWORD;
    private $dbname   = DATABASE;

    // Constructor maakt de connectie aan (indien nog niet bestaand)
    public function __construct() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host={$this->servername};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );

                // Zet foutafhandeling en fetch-mode
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // echo "✅ Connectie succesvol";
            } catch (PDOException $e) {
                echo "❌ Connectie mislukt: " . $e->getMessage();
            }
        }
    }

    // Methode om de databaseconnectie op te halen
    public function getConnection() {
        return self::$conn;
    }
}
