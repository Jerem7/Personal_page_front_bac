<?php
require_once "init.php";
include "includes/header.php";
includeAssets();

// Pobranie wpisów na blogu z bazy danych
$query = "SELECT * FROM blog_posts ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<main>
    <h1>Witaj na mojej stronie!</h1>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <article>
                <h2><?php echo htmlspecialchars($row["title"]); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($row["content"])); ?></p>
                <p><small>wstawiono: <?php echo $row[
                        "created_at"
                        ]; ?></small></p>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Chwilowy brak wpisów :(</p>
    <?php endif; ?>
</main>
<?php include "includes/footer.php"; ?>
