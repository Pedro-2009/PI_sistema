document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".btn-delete").forEach(btn => {
        btn.addEventListener("click", () => {

            const id = btn.getAttribute("data-id");
            const module = btn.getAttribute("data-module");

            const modal = new bootstrap.Modal(document.getElementById("deleteModal"));

            // configura o link final
            const deleteBtn = document.getElementById("confirm-delete-btn");
            deleteBtn.href = `/PI_sistema-1/modules/${module}/delete.php?id=${id}`;

            modal.show();
        });
    });
});
