<div class="modal-pagina-publicacao" id="modalCriarPublicacao">
        <div class="cabecalho-criar-publicacao">
            <h3>Criar Publicação</h3>
            <i class="fa-solid fa-xmark icone-fechar-modal-visualizar" onclick="fecharModal('modalCriarPublicacao')"></i>
        </div>
        
        <hr class="linha-separadora">
    <!-- Modal CRIAR -->
        <form action="/publicacoes/store" method="POST">
            <h3>Título da publicação</h3>
            <input id="input-tituloModalCriar" name="titulo" placeholder="Digite o título da publicação..." type="text" class="input-modal-titulo" required>

            <h4>Conteúdo</h4>
            <div id="editor" name="editordata">
                <textarea id="summernoteCriar" name="conteudo"></textarea>
            </div>

            <div class="post-options">
                <h3>Opções do post</h3>
                
        <div class="opcao-checkbox-container">
            <label class="checkbox-container">
                <input type="checkbox" id="toggle-curiosidade">
                <span>Adicionar curiosidade</span>
            </label>
        </div>

        <input type="text" id="input-container-curiosidade" class="input-curiosidade" name="curiosidade" placeholder="Digite o texto da curiosidade..."></textarea>

        <div class="grupo-data-modal">
            <label for="input-dataPublicacao" class="label-modal-visualizar">Data de publicação:</label>
            <input id="input-dataPublicacao" name="data" type="date" class="input-modal-visualizar" required>
        </div>
                
        <hr class="linha-separadora">
        <div class="botoesModalCriarPub">
            <button type="button" class="cancelarBotaoModal" onclick="fecharModal('modalCriarPublicacao')">Cancelar</button>
            <button type="submit" class="enviarBotaoModal">Enviar</button>
        </div>
            </div>
        </form>
</div>