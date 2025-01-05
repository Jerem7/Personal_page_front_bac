<?php
// Rozpoczęcie sesji i połączenie z bazą danych za pomocą init.php
require_once 'init.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Sprawdzenie, czy formularz został przesłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pobranie danych z formularza
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']);

    // Walidacja danych
    if (!empty($title) && !empty($description)) {
        // Przygotowanie zapytania SQL
        $stmt = $conn->prepare("INSERT INTO projects (title, description, image_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $image_url);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            // Przekierowanie na dashboard z komunikatem o sukcesie
            header('Location: dashboard.php?success=Project added successfully');
            exit;
        } else {
            $error = "Błąd podczas dodawania projektu: " . $conn->error;
        }
    } else {
        $error = "Wszystkie wymagane pola muszą być wypełnione.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
    <h1>Add New Project</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="add_project.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url">

        <button type="submit">Add Project</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
