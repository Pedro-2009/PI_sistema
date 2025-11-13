document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const titleSpan = document.getElementById("delete-title");
    const confirmLink = document.getElementById("delete-confirm");

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-id");
            const titulo = btn.getAttribute("data-titulo");

            // Preencher título no modal
            titleSpan.textContent = titulo;

            // Definir link real do delete
            confirmLink.href = `delete.php?id=${id}`;

            // Abrir modal
            const modal = new bootstrap.Modal(document.getElementById("deleteModal"));
            modal.show();
        });
    });
});
