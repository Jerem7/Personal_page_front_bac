<?php
// Załadowanie połączenia z bazą danych i rozpoczęcie sesji
require_once 'init.php';

// Pobranie projektów z bazy danych
$query = "SELECT * FROM projects ORDER BY created_at DESC";
$result = $conn->query($query);
includeAssets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>
<body>
<?php include 'includes/header.php'; ?>

<main>
    <h1>Projects</h1>
    <section class="projects-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <article class="project">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <?php if (!empty($row['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Project Image" onclick="openModal(this)">
                <?php endif; ?>
                <p><small>Added on: <?php echo $row['created_at']; ?></small></p>
            </article>
        <?php endwhile; ?>
    </section>
</main>

<!-- Modal Structure -->
<div id="imageModal" class="modal" style="display: none;">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
