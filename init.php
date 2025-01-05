<?php
// Rozpoczęcie sesji, jeśli nie została rozpoczęta
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ustawienia błędów
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Połączenie z bazą danych
$host = 'localhost';
$dbname = 'portfolio';
$db_user = 'root';
$db_pass = '';
$conn = new mysqli($host, $db_user, $db_pass, $dbname);

// Sprawdzanie połączenia z bazą
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Funkcja do załączania zasobów (stylów, skryptów)
function includeAssets() {
    echo '
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="assets/js/script.js" defer></script>
    ';
}

