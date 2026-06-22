<div class="modal-pagina-publicacao" id="modalCriarPublicacao">
    <div class="cabecalho-criar-publicacao">
        <h2>Criar Publicação</h2>
        <i class="fa-solid fa-xmark icone-fechar-modal-visualizar" onclick="fecharModal('modalCriarPublicacao')"></i>
    </div>

    <hr class="linha-separadora">
    <!-- Modal CRIAR -->
    <form action="/publicacoes/store" method="POST" enctype="multipart/form-data">

        <div class="grupo-inputs-modal">
            <h3>Título da publicação</h3>
            <input id="input-tituloModalCriar" name="titulo" placeholder="Digite o título da publicação..." type="text"  required>
        </div>

        <h3>Conteúdo</h3>
        <div id="editor" name="editordata">
            <textarea id="summernoteCriar" name="conteudo"></textarea>
        </div>

        <div class="grupo-inputs-modal">
            <h3>Adicionar imagem de capa</h3>
            <input type="file" name="imagem" accept="image/*" class="form-control" id="input-imagemModalCriar">
        </div>

         <div class="grupo-inputs-modal">
            <h3>Imagem selecionada:</h3>
            <img id="imagemSelecionada" alt="imagem Selecionada" style="display:none;" />
        </div>

        <div class="grupo-inputs-modal">
            <h3>Curiosidade do post</h3>

            <div class="opcao-checkbox-container">
                <label class="checkbox-container">
                    <input type="checkbox" id="toggle-curiosidade">
                    <span class="checkbox-label-text">Adicionar curiosidade?</span>
                </label>
            </div>
 
            <textarea class="input-curiosidades-modal escondido" name="curiosidade" id="input-curiosidades-modal"> </textarea>
        </div>
        
        <div class="grupo-inputs-modal">
            <h3>Adicionar categoria</h3>
            <select name="categoria" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria ?>">
                        <?= $categoria ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <hr class="linha-separadora">
        <div class="botoesModalCriarPub">
            <button type="button" class="cancelarBotaoModal" onclick="fecharModal('modalCriarPublicacao')">Cancelar</button>
            <button type="submit" class="enviarBotaoModal">Enviar</button>
        </div>
    </form>
</div>