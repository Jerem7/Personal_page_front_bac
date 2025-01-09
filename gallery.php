<?php
require_once "init.php";
include "includes/header.php";
includeAssets();

// Pobranie obrazów z bazy danych
$query = "SELECT * FROM gallery ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<main>
    <h1>Galeria</h1>
    <p>Galeria obrazów</p>
    <section class="gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <article class="gallery-item">
                <h2><?php echo htmlspecialchars($row["title"]); ?></h2>
                <img src="<?php echo htmlspecialchars(
                    $row["file_path"]
                ); ?>" alt="Gallery Image" onclick="openModal(this)">
            </article>
        <?php endwhile; ?>
    </section>

    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
</main>

<?php include "includes/footer.php"; ?>
