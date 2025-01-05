// Otwórz modal z obrazem
function openModal(image) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImg");
    modal.style.display = "flex";
    modalImg.src = image.src;
}

// Zamknij modal
function closeModal() {
    const modal = document.getElementById("imageModal");
    modal.style.display = "none";
}
