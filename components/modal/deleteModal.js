document.addEventListener("DOMContentLoaded", () => {
    const deleteModal = document.getElementById("deleteModal");
    const deleteConfirmBtn = document.getElementById("deleteConfirmBtn");

    // Escutar qualquer botão que chamar o modal
    document.querySelectorAll(".openDeleteModal").forEach(button => {
        button.addEventListener("click", function () {
            const url = this.getAttribute("data-url");
            deleteConfirmBtn.setAttribute("href", url);

            // Abrir o modal
            const modal = new bootstrap.Modal(deleteModal);
            modal.show();
        });
    });
});
