<div class="modal-container-flutuante" id="modalExcluirPublicacao-<?= $publicacao->id ?>">
    
    <div class="modalExcluirUsuario">
        
        <h3 class="titulo-modal-excluir">Excluir Publicação</h3>
        <hr class="linha-separadora-modal-excluir">
        
        <div class="container-icone-modal-excluir">
            <span class="material-icons icone-alerta-modal-excluir">error</span>
        </div>
        
        <p class="descricao-modal-excluir">Essa ação é irreversível. Você tem certeza que deseja excluir essa publicação?</p>

        <form method="POST" action="/publicacoes/delete">
            <input type="hidden" name="id" value="<?= $publicacao->id ?>">
            
            <div class="botoesModalExcluirUsuario">
                <button type="button" class="cancelarBotaoModalDeExclusao" onclick="fecharModal('modalExcluirPublicacao-<?= $publicacao->id ?>')">Cancelar</button>
                <button type="submit" class="excluirBotaoModal">Excluir</button>
            </div>
        </form>
    </div>
</div>