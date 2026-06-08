<div class="modal-pagina-publicacao" id="modalCriarPublicacao">
    <div class="cabecalho-criar-publicacao">
        <h2>Criar Publicação</h2>
        <i class="fa-solid fa-xmark icone-fechar-modal-visualizar" onclick="fecharModal('modalCriarPublicacao')"></i>
    </div>

    <hr class="linha-separadora">
    <!-- Modal CRIAR -->
    <form action="/publicacoes/store" method="POST">
        <h3>Título da publicação</h3>
        <input id="input-tituloModalCriar" name="titulo" placeholder="Digite o título da publicação..." type="text" class="input-modal-titulo" required>

        <h3>Conteúdo</h3>
        <div id="editor" name="editordata">
            <textarea id="summernoteCriar" name="conteudo"></textarea>
        </div>

        <h3>Adicionar imagem de capa</h3>
        <input type="file" name="imagem" accept="image/*" class="input-imagem-criar" id="input-imagemModalCriar">

        <div class="post-options">
            <h3>Opções do post</h3>

            <!-- To-do: REFATORAR JS E REMOVER FUNÇÃO DE TOGGLE! -->
            <!-- <div class="opcao-checkbox-container">
                <label class="checkbox-container">
                    <input type="checkbox" id="toggle-curiosidade">
                    <span>Adicionar curiosidade</span>
                </label>
            </div>
 
            <div class="input-container-curiosidade">
                <label for="input-curiosidade" class="label-modal-criar">Curiosidade:</label>
                <input type="text" id="input-curiosidade" class="input-modal-criar" rows=10 columns=10 name="curiosidade" placeholder="Digite o texto da curiosidade...">
            </div> -->

            
            <input id="input-curiosidadeModalCriar" name="curiosidade" placeholder="Digite a curiosidade da publicação... (opcional)" type="text" class="input-modal-curiosidade">

            <div class="grupo-data-modal">
                <label for="input-dataPublicacao" class="label-modal-criar">Data de publicação:</label>
                <input type="date" id="input-dataPublicacao" class="input-modal-criar" name="data" required>
            </div>

            <hr class="linha-separadora">
            <div class="botoesModalCriarPub">
                <button type="button" class="cancelarBotaoModal" onclick="fecharModal('modalCriarPublicacao')">Cancelar</button>
                <button type="submit" class="enviarBotaoModal">Enviar</button>
            </div>
        </div>
    </form>
</div>