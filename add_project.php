<?php
// Rozpoczęcie sesji i połączenie z bazą danych za pomocą init.php
require_once "init.php";

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Pobranie danych z formularza
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $image_url = trim($_POST["image_url"]);

    // Walidacja danych
    if (!empty($title) && !empty($description)) {
        // Przygotowanie zapytania SQL
        $stmt = $conn->prepare(
            "INSERT INTO projects (title, description, image_url) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $title, $description, $image_url);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            // Przekierowanie na dashboard z komunikatem o sukcesie
            header(
                "Location: dashboard.php?success=Projekt dodany"
            );
            exit();
        } else {
            $error = "Błąd podczas dodawania projektu: " . $conn->error;
        }
    } else {
        $error = "Wszystkie wymagane pola muszą być wypełnione.";
    }
}
?>


