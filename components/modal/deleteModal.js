document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteModal = document.getElementById('deleteModal');
    const deleteMessage = document.getElementById('deleteModalMessage');
    const confirmBtn = document.getElementById('confirmDeleteBtn');

    if (!deleteModal) return;

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const title = btn.getAttribute('data-title');

            deleteMessage.textContent = `Deseja realmente excluir "${title}"?`;

            confirmBtn.href = `delete.php?id=${id}`;

            const modal = new bootstrap.Modal(deleteModal);
            modal.show();
        });
    });
});
