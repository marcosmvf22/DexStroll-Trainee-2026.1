<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/tabela_publicacoes.css"> 
    <link rel="stylesheet" href="/public/css/modalpadronizado.css">
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
        crossorigin="anonymous" referrerpolicy="no-referrer" 
    />

    <!-- CSS sidebar -->
    <link rel="stylesheet" href="../../../public/css/Sidebar.css">
     
    <title>Painel de Publicações - DexStroll</title>
    <link rel="icon" type="image/png" href="/public/assets/favicon.png">
</head>

<body class="body-pagina-publicacao">
    <? require 'Sidebar.view.php' ?>
    <div class="filtro" id="filtroFundoModal"></div>
    <div class="pagina-publicacao">
        <header class="header-pag-publicacao">
            <h1>Publicações</h1>
            <h3><?= $totalPosts?> publicações encontradas</h3>
        </header>

        <div class="card-tabela">
            <div class="topo-tabela">
                 <form action="/listadeposts" method="GET" class="pesquisapost">
              <div class="grupo-busca">
                <input 
                  type="text" 
                  name="pesquisa" 
                  placeholder="Buscar por publicações..." 
                  value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>"
                  class="input-busca-admin">
                  <button type="submit" class="btn-busca-admin" title="Pesquisar">
                  <span class="material-icons">search</span>
                </button>
              </div>
            </form>
                <button class="criar-publicacao-admin" onclick="abrirModal('modalCriarPublicacao')">
                    <span class="material-symbols-outlined">library_books</span>
                    <span class="texto-botao">Criar publicação</span>
                </button>
            </div>
            <div class="warper-tabela">
                <table class="tabela-admin">
                    <thead>
                        <tr class="cabecalho-tabela-admin">
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Categoria</th>
                            <th>Data de criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($publicacoes as $publicacao): ?>
                            <tr>
                                <td class="dado_id_admin"><?= $publicacao->id ?></td>
                                <td class="dado_titulo_admin"><?= $publicacao->titulo ?></td>
                                <td class="dado_autor_admin"><?= $publicacao->autor ?></td>
                                <td class="dado_categoria_admin"><?= $publicacao->categoria ?> </td>
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
            <?php require 'paginacao.view.php' ?>
        </div>
    </div>


    <?php require __DIR__ . '/modais/modal_criar.view.php'; ?>

    <?php foreach ($publicacoes as $publicacao): ?>
        <?php require __DIR__ . '/modais/modal_visualizar.view.php'; ?>
        <?php require __DIR__ . '/modais/modal_editar.view.php'; ?>
        <?php require __DIR__ . '/modais/modal_deletar.view.php'; ?> 
    <?php endforeach ?>


    <script src="/public/js/summernoteConfig.js"></script>
    <script src="/public/js/codigoModalPublicacoes.js"></script>
</body>
<!-- JS sidebar -->
  <script src="/public/js/Sidebar.js"></script>
</html>