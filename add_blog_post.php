<?php
require_once "init.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Zapis do bazy danych
    $query = "INSERT INTO blog_posts (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        echo "Wpis dodany!";
        header("Location: dashboard.php"); // Przekierowanie na dashboard
        exit();
    } else {
        echo "błąd: " . $conn->error;
    }
}
?>
