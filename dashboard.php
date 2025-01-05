<?php
session_start();
require_once 'init.php';

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Dołączenie konfiguracji i połączenia z bazą
require_once 'init.php';

// Pobranie projektów z bazy danych
$query = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($query);

// Sprawdzenie, czy zapytanie się powiodło
if (!$result) {
    die("Błąd zapytania: " . $conn->error);
}
includeAssets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
    <h1>Dashboard</h1>

    <section>
        <h2>Projects</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image URL</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['image_url']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak projektów do wyświetlenia.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Add New Project</h2>
        <form action="add_project.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url">

            <button type="submit">Add Project</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
