<?php
$host = 'localhost';
$dbname = 'portfolio';
$username = 'root'; // Twój użytkownik MySQL
$password = ''; // Hasło do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
