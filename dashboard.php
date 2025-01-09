<?php
session_start();
require_once "init.php";

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

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
<body> <?php include 'includes/header.php'; ?> <main>
    <section>
        <h2>Dodaj projekt</h2>
        <form action="add_project.php" method="POST">
            <label for="title">Tytuł projektu:</label>
            <input type="text" id="title" name="title" required>
            <label for="description">Opis:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="image_url">URL zdjęcia:</label>
            <input type="text" id="image_url" name="image_url">
            <button type="submit">Dodaj projekt</button>
        </form>
    </section>
    <section>
        <h2>zarządzanie projektami</h2>
        <table>
            <thead>
            <tr>
                <th>tytuł</th>
                <th>czynność</th>
            </tr>
            </thead>
            <tbody> <?php
            $query = "SELECT * FROM projects ORDER BY created_at DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()): ?> <tr>
                    <td> <?php echo htmlspecialchars($row['title']); ?> </td>
                    <td>
                        <form action="delete_project.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="
														<?php echo $row['id']; ?>">
                            <button type="submit">Usuń</button>
                        </form>
                    </td>
                </tr> <?php endwhile;
            else: ?> <tr>
                <td colspan="2">Brak projektów</td>
            </tr> <?php endif; ?> </tbody>
        </table>
    </section>
    <section>
        <h2>Dodaj post na bloga</h2>
        <form action="add_blog_post.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="content">treść:</label>
            <textarea id="content" name="content" required></textarea>
            <button type="submit">upublicznij post</button>
        </form>
    </section>
    <section>
        <h2>zarządzaj wpisami na blogu</h2>
        <table>
            <thead>
            <tr>
                <th>tytuł</th>
                <th>czynność</th>
            </tr>
            </thead>
            <tbody> <?php
            $query = "SELECT * FROM blog_posts ORDER BY created_at DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()): ?> <tr>
                    <td> <?php echo htmlspecialchars($row['title']); ?> </td>
                    <td>
                        <form action="delete_blog_post.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="
																<?php echo $row['id']; ?>">
                            <button type="submit">Usuń</button>
                        </form>
                    </td>
                </tr> <?php endwhile;
            else: ?> <tr>
                <td colspan="2">brak wpisów na blogu</td>
            </tr> <?php endif; ?> </tbody>
        </table>
    </section>
    <section>
        <h2>dodaj obraz do galerii</h2>
        <form action="upload_image.php" method="POST" enctype="multipart/form-data">
            <label for="title">Image Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="image">Choose Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <button type="submit">wrzuć obraz</button>
        </form>
    </section>
    <section>
        <h2>zarządzaj galerią</h2>
        <table>
            <thead>
            <tr>
                <th>nazwa obrazu</th>
                <th>czynność</th>
            </tr>
            </thead>
            <tbody> <?php
            $query = "SELECT * FROM gallery ORDER BY created_at DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()): ?> <tr>
                    <td> <?php echo htmlspecialchars($row['title'] ?? 'Unknown'); ?> </td>
                    <td>
                        <form action="delete_gallery_image.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="
																			<?php echo $row['id']; ?>">
                            <button type="submit">Usuń</button>
                        </form>
                    </td>
                </tr> <?php endwhile;
            else: ?> <tr>
                <td colspan="2">brak obrazów w galerii</td>
            </tr> <?php endif; ?> </tbody>
        </table>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>