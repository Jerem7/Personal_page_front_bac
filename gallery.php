<?php include 'includes/header.php';
require_once 'init.php';
includeAssets();
?>
<main>
    <h1>Gallery</h1>
    <p>Here you will find a collection of my favorite images.</p>
    <section class="gallery">
        <article class="gallery-item">
            <h2>Sample Project</h2>
            <img src="assets/images/sample.jpg" alt="Sample Image" onclick="openModal(this)">
        </article>
    </section>

    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>

    <!-- Galeria obrazów -->
</main>
<?php include 'includes/footer.php'; ?>
