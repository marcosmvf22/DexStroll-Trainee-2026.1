<div class="modal-editar-publicacao" id="modalEditarPublicacao-<?= $publicacao->id ?>">
    <h3 class="titulo-modal-visualizar">Editar Publicação</h3>
    <hr class="linha-separadora-modal-excluir">

    <form method="POST" action="/publicacoes/edit">
        <input type="hidden" name="id" value="<?= $publicacao->id ?>">

        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">Título:</label>
            <input name="titulo" type="text" class="input-modal-visualizar" value="<?= $publicacao->titulo ?>">
        </div>

        <div class="box2-modal">
            <div class="grupo-inputs-modal">
                <label class="label-modal-visualizar">Autor:</label>
                <input name="autor" type="text" class="input-modal-visualizar" value="<?= $publicacao->autor ?>">
            </div>
            <div class="grupo-inputs-modal">
                <label class="label-modal-visualizar">Data de publicação:</label>
                <input class="input-dataPublicacaoModal" type="date" name="data" value="<?= $publicacao->data ?>">
            </div>
        </div>

        <div id="editor-modal-editar">
            <textarea class="summernoteEditar" name="conteudo"><?= $publicacao->conteudo ?></textarea>
        </div>

        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">Curiosidades:</label>
            <textarea class="input-curiosidades-modal" name="curiosidade"><?= $publicacao->curiosidade ?></textarea>
        </div>

        <div class="botoesModalEditarPub">
            <button class="cancelarBotaoModalEditar" type="button" onclick="fecharModal('modalEditarPublicacao-<?= $publicacao->id ?>')">Cancelar</button>
            <button class="enviarBotaoModalEditar" type="submit">Enviar</button>
        </div>
    </form>
</div>