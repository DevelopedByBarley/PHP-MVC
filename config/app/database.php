<?php

// Singleton mintát alkalmazó adatbázis osztály
class Database
{
    private static $instance = null; // Az adatbázis kapcsolat példányát tároló statikus változó
    private $pdo; // PDO objektum tárolása

    // Privát konstruktor, hogy ne lehessen közvetlenül példányosítani az osztályt
    private function __construct()
    {
        $servername = $_SERVER['DB_HOST'];
        $username = $_SERVER['DB_USERNAME'];
        $password = $_SERVER['DB_PASSWORD'];
        $dbName = $_SERVER['DB_NAME'];

        try {
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbName;charset=utf8mb4", $username, $password);
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit; // Kilépés a hiba esetén
        }
    }

    // Statikus metódus az egyetlen adatbázis példány lekérésére
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(); // Új példány létrehozása, ha még nem létezik
        }
        return self::$instance->pdo; // Az adatbázis PDO objektum visszaadása
    }
}

// Biztonságos érték idézőjelbe tétele
function safeQuote($value)
{
    $pdo = Database::getInstance(); // PDO objektum megszerzése
    if (is_null($value)) {
        return 'NULL';
    } else {
        return $pdo->quote($value);
    }
}

// Adatbázis exportálása SQL fájlba PDO segítségével
function exportDatabaseUsingPDO($outputFile)
{
    try {
        $pdo = Database::getInstance(); // PDO objektum megszerzése

        // Fetch all tables in the database
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

        $output = fopen($outputFile, 'w'); // Fájl megnyitása írásra

        // Iterate through each table
        foreach ($tables as $table) {
            // Export table structure
            $stmt = $pdo->query("SHOW CREATE TABLE `$table`");
            $createTable = $stmt->fetch(PDO::FETCH_ASSOC);
            fwrite($output, "-- Table structure for `$table`\n");
            fwrite($output, $createTable['Create Table'] . ";\n\n");

            // Export table data
            $stmt = $pdo->query("SELECT * FROM `$table`");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rowValues = array_map(function($value) {
                    return safeQuote($value);
                }, $row);
                $rowValues = implode(", ", $rowValues);
                fwrite($output, "INSERT INTO `$table` VALUES ($rowValues);\n");
            }
            fwrite($output, "\n");
        } 

        fclose($output); // Fájl lezárása
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Példa használat: adatbázis exportálása fájlba
$outputFile = 'backup/db/db.sql';  // Adja meg a kívánt kimeneti fájl elérési útját
if (defined('DATABASE_BACKUP_PERM') && DATABASE_BACKUP_PERM) {
    exportDatabaseUsingPDO($outputFile); // Adatbázis exportálása
}
