<?php
require_once 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Pobranie nazwy pliku do usunięcia
    $query = "SELECT file_name FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file_name);
    $stmt->fetch();
    $stmt->close();

    // Usunięcie pliku z dysku
    $file_path = "static/gallery/" . $file_name;
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Usunięcie wpisu z bazy danych
    $query = "DELETE FROM gallery WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "błąd usuwania obrazu z galerii: " . $conn->error;
    }
}
?>
