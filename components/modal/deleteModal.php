<?php
// COMPONENTE DE MODAL GLOBAL
?>
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Tem certeza que deseja excluir este item?
                <input type="hidden" id="delete-item-id">
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="confirm-delete-btn" class="btn btn-danger">Excluir</a>
            </div>

        </div>
    </div>
</div>
