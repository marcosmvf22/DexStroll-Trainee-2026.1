<div class="modal-excluir-publicacao" id="modalExcluirPublicacao-<?= $publicacao->id ?>">
    <h3 class="titulo-modal-excluir">Excluir Publicação</h3>
    <hr class="linha-separadora-modal-excluir">
    <div class="container-icone-modal-excluir">
        <i class="fa-solid fa-circle-exclamation icone-alerta-modal-excluir"></i>
    </div>
    <p class="descricao-modal-excluir">Essa ação é irreversível. Você tem certeza que deseja excluir essa publicação?</p>

    <form method="POST" action="/publicacoes/delete">
        <input type="hidden" name="id" value="<?= $publicacao->id ?>">
        <div class="botoesModalExcluirPub">
            <button type="button" class="cancelarBotaoModalDeExclusao" onclick="fecharModal('modalExcluirPublicacao-<?= $publicacao->id ?>')">Cancelar</button>
            <button type="submit" class="excluirBotaoModal">Excluir</button>
        </div>
    </form>
</div>