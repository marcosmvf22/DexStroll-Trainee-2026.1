<div class="modal-visualizar-publicacao" id="modalVisualizarPublicacao-<?= $publicacao->id ?>">
    <div class="nav-modal-excluir">
        <h3 class="titulo-modal-visualizar">Visualizar Publicação</h3>
        <i class="fa-solid fa-xmark icone-fechar-modal-visualizar" onclick="fecharModal('modalVisualizarPublicacao-<?= $publicacao->id ?>')"></i>
    </div>
    <hr class="linha-separadora-modal-excluir">

    <div class="box1-modal">
        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">ID:</label>
            <input type="text" class="input-modal-visualizar" value="<?= $publicacao->id ?>" disabled>
        </div>
        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">Título:</label>
            <input type="text" class="input-modal-visualizar" value="<?= $publicacao->titulo ?>" disabled>
        </div>
    </div>

    <div class="box2-modal">
        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">Autor:</label>
            <input type="text" class="input-modal-visualizar" value="<?= $publicacao->autor ?>" disabled>
        </div>
        <div class="grupo-inputs-modal">
            <label class="label-modal-visualizar">Data de publicação:</label>
            <input type="date" class="input-dataPublicacaoModal" value="<?= $publicacao->data ?>" disabled>
        </div>
    </div>

    <div class="imagem-principal-modal-excluir">
        <p class="label-modal-visualizar">Imagem principal:</p>
        <div class="img-principal-placeholder-modal">
           <img src="/<?= $publicacao->imagem ?>" alt="imagem" style="max-width: 100%; height: auto;">
        </div>
    </div>

    <div id="editor-modal-visualizar">
        <p class="label-modal-visualizar">Descrição:</p>
        <textarea class="summernoteVisualizar" name="conteudo"><?= $publicacao->conteudo ?></textarea>
    </div>

    <div class="grupo-inputs-modal">
        <label class="label-modal-visualizar">Curiosidades:</label>
        <textarea class="input-curiosidades-modal" disabled><?= $publicacao->curiosidade ?></textarea>
    </div>
</div>