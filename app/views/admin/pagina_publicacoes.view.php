<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/tabela_publicacoes.css"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=library_books" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Painel - DexStroll</title>
</head>
<body class="body-pagina-publicacao">
    <div class="filtro" id="filtroFundoModal"></div>
    <div class="pagina-publicacao">
        <header class="header-pag-publicacao">
            <h1>Publicações</h1>
            <h3><?= count($publicacoes) ?> publicações encontradas</h3>
        </header>

        <div class="card-tabela">
            <div class="topo-tabela">
                <button class="criar-publicacao-admin" onclick="abrirModal('modalCriarPublicacao')">
                    <span class="material-symbols-outlined">library_books</span>Criar publicação</button>
            </div>
            
            <table class="tabela-admin">
                <thead>
                    <tr class="cabecalho-tabela-admin">
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($publicacoes as $publicacao): ?>
                    <tr>
                        <td class="dado_id_admin"><?= $publicacao->id ?></td>
                        <td class="dado_titulo_admin"><?= $publicacao->titulo ?></td>
                        <td class="dado_autor_admin"><?= $publicacao->autor ?></td>
                        <td class="dado_data_criacao_admin"><?= date('d/m/Y', strtotime($publicacao->data)) ?></td>
                        <td class="celula-acoes-admin">
                            <button class="botao-acao botao-visualizar-admin" onclick="abrirModal('modalVisualizarPublicacao-<?= $publicacao->id ?>')" title="Visualizar">
                                <span class="material-icons">visibility</span>
                            </button>
                            <button class="botao-acao botao-editar" onclick="abrirModal('modalEditarPublicacao-<?= $publicacao->id ?>')" title="Editar">
                                <span class="material-icons">edit</span>
                            </button>
                            <button class="botao-acao botao-deletar" onclick="abrirModal('modalExcluirPublicacao-<?= $publicacao->id ?>')" title="Deletar">
                                <span class="material-icons">delete</span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="paginacao">
            <button class="btn-pag">&lt;</button>
            <button class="btn-pag ativo">1</button>
            <button class="btn-pag">&gt;</button>
        </div>
    </div>
    
    <div class="modal-pagina-publicacao" id="modalCriarPublicacao">
        <h3>Criar Publicação</h3>
        <hr class="linha-separadora">
        
        <!-- Modal CRIAR -->
        <form action="/publicacoes/store" method="POST">
            <h4>Título da publicação</h4>
            <input id="input-tituloModalCriar" name="titulo" type="text" class="input-modal-titulo">

            <h4>Conteúdo</h4>
            <div id="editor" name="editordata">
                <textarea id="summernoteCriar" name="descricao"></textarea>
            </div>

            <div class="post-options">
                <h3>Opções do post</h3>
                
                <label class="checkbox-container">
                    <input type="checkbox" id="toggle-curiosidade">
                    <span>Adicionar curiosidade</span>
                </label>

                <div id="input-container" class="hidden">
                    <textarea placeholder="Digite o texto da curiosidade" rows="3" name="curiosidade"></textarea>
                </div>

                <div class="grupo-data-modal">
                    <label for="input-dataPublicacao" class="labal-modal-visualizar">Data de publicação:</label>
                    <input id="input-dataPublicacao" name="data" type="date" class="input-modal-visualizar" required>
                </div>
                
                <div class="botoesModalCriarPub">
                    <button type="button" class="cancelarBotaoModal" onclick="fecharModal('modalCriarPublicacao')">Cancelar</button>
                    <button type="submit" class="enviarBotaoModal">Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <?php foreach($publicacoes as $publicacao): ?>
    <!-- Modal VISUALIZAR -->
    <div class="modal-visualizar-publicacao" id="modalVisualizarPublicacao-<?= $publicacao->id ?>">
        <div class="nav-modal-excluir">
            <h3 class="titulo-modal-visualizar">Visualizar Publicação</h3>
            <i class="fa-solid fa-xmark icone-fechar-modal-visualizar" onclick="fecharModal('modalVisualizarPublicacao-<?= $publicacao->id ?>')"></i>
        </div>
        <hr class="linha-separadora-modal-excluir">

        <div class="box1-modal">
            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">ID:</label>
                <input type="text" class="input-modal-visualizar" value="<?= $publicacao->id ?>" disabled>
            </div>
            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">Título:</label>
                <input type="text" class="input-modal-visualizar" value="<?= $publicacao->titulo ?>" disabled>  
            </div>
        </div>

        <div class="box2-modal">
            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">Autor:</label>
                <input type="text" class="input-modal-visualizar" value="<?= $publicacao->autor ?>" disabled>
            </div>
            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">Data de publicação:</label>
                <input type="date" class="input-dataPublicacaoModal" value="<?= $publicacao->data ?>" disabled>
            </div>
        </div>  

        <div class="imagem-principal-modal-excluir">
            <label class="labal-modal-visualizar">Imagem principal:</label>
            <div class="img-principal-placeholder-modal">
                <i class="fa-regular fa-image icone-imagem-modal"></i>
            </div>
        </div>

        <div id="editor-modal-visualizar">
            <textarea class="summernoteVisualizar" name="descricao"><?= $publicacao->conteudo ?></textarea>
        </div>

        <div class="grupo-inputs-modal">
             <label class="labal-modal-visualizar">Curiosidades:</label>
             <textarea class="input-curiosidades-modal" disabled><?= $publicacao->curiosidade ?></textarea>
        </div>    
    </div>

    <div class="modal-editar-publicacao" id="modalEditarPublicacao-<?= $publicacao->id ?>">
        <h3 class="titulo-modal-visualizar">Editar Publicação</h3>
        <hr class="linha-separadora-modal-excluir">

        <form method="POST" action="/publicacoes/edit">
            <input type="hidden" name="id" value="<?= $publicacao->id ?>">

            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">Título:</label>
                <input name="titulo" type="text" class="input-modal-visualizar" value="<?= $publicacao->titulo ?>" >  
            </div>

            <div class="box2-modal">
                <div class="grupo-inputs-modal">
                    <label class="labal-modal-visualizar">Autor:</label>
                    <input name="autor" type="text" class="input-modal-visualizar" value="<?= $publicacao->autor ?>">
                </div>
                <div class="grupo-inputs-modal">
                    <label class="labal-modal-visualizar">Data de publicação:</label>
                    <input class="input-dataPublicacaoModal" type="date" name="data" value="<?= $publicacao->data ?>">
                </div>
            </div>   

            <div id="editor-modal-editar">
                <textarea class="summernoteEditar" name="descricao"><?= $publicacao->conteudo ?></textarea>
            </div>

            <div class="grupo-inputs-modal">
                <label class="labal-modal-visualizar">Curiosidades:</label>
                <textarea class="input-curiosidades-modal" name="curiosidade"><?= $publicacao->curiosidade ?></textarea>
            </div>

            <div class="botoesModalEditarPub">
                <button class="cancelarBotaoModalEditar" type="button" onclick="fecharModal('modalEditarPublicacao-<?= $publicacao->id ?>')">Cancelar</button>
                <button class="enviarBotaoModalEditar" type="submit">Enviar</button>
            </div>
        </form>
    </div>

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
    <?php endforeach ?>
    
    <script>
        $(document).ready(function() {
            $('#summernoteCriar').summernote({
                height: 300,             
                width: '100%',           
                maxHeight: 500,          
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('.summernoteEditar').summernote({
                height: 300,             
                width: '100%',           
                maxHeight: 500,          
                minHeight: 150,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('.summernoteVisualizar').summernote({
                height: 300,            
                toolbar: []
            });
            $('.summernoteVisualizar').summernote('disable');
        });
    </script>

    <script src="/public/js/codigoModalPublicacoes.js"></script>
</body>
</html>