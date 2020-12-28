<div class="modal fade" id="modal_excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_excluir" id="id_excluir" />
                Deseja excluir o item: <label id="nome_excluir"></label> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" name="btnExcluir">Confirmar</button>
            </div>
        </div>
    </div>
</div>