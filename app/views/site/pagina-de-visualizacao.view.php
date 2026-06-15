<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/pagina-de-visualizacao.css">
    <title>Pagina de Visualização Unica - DexStroll</title>
</head>
<body>
         
    <?php require "navbar.view.php"?>
    <main class="pagina-de-visualizacao-unica">

        <!-- Titulo da pagina -->
        
        <div class="area-de-titulo">
            <img class="imagem-capa-post" src="<?= $publicacao->imagem ?>" alt="Imagem de capa do titulo">

            <div class="overlay-area-de-titulo"></div> 
            <div class="conteudo-do-titulo">
                
                <a href="#" class="tag-categoria"><?=$publicacao->categoria?></a>
                <h1><?=$publicacao->titulo?></h1>
                <p><?=$publicacao->autor?> • <?=date('d/m/Y', strtotime($publicacao->data))?></p>
            </div>
        </div>

        <!-- Conteudo da pagina -->

        <div class="conteudo-da-pagina">
            <?= $publicacao->conteudo ?>
        </div>

        <?php if ($temCuriosidade): ?>
            <div class="caixa-de-curiosidade">
                <div class="cabecalho-caixa-de-curiosidade">
                    <i class="material-icons">error</i>
                    <h1>Você sabia?</h1>
                </div>
                <div class="conteudo-caixa-de-curiosidade">
                    <?= $publicacao->curiosidade ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- Posts relacionados -->

        <div class="posts_relacionados">
            <h1>Posts Relacionados</h1>
            <?php if (!empty($postsRelacionados)): ?>
                
                <!-- Area do carrossel -->
                <div class="carrossel">

                    <!-- Lista de posts do carrossel -->

                    <div class="carrossel-conteudo">
                       

                        <!-- Cards -->

                        <ul>
                            <?php foreach ($postsRelacionados as $post): ?>
                                <li class="cards_carrossel">

                                    <div class="fundo-conteudo-cards">
                                        <img
                                            src="<?= !empty($post->imagem)
                                                ? $post->imagem
                                                : 'https://picsum.photos/1920/1080?random' ?>"
                                            alt="<?= htmlspecialchars($post->titulo) ?>"
                                        >

                                        <div class="data-tag">
                                            <h6>
                                                <?= date('d/m/Y', strtotime($post->data)) ?>
                                            </h6>
                                            
                                            <span class="tag-categoria tag-cards">
                                                <?= htmlspecialchars($post->categoria) ?>
                                            </span>
                                        </div>
                                        
                                        <h4>
                                            <?= htmlspecialchars($post->titulo) ?>
                                        </h4>
                                        
                                        <div class="dados-autor-landing">
                                            <h5>
                                                <?= htmlspecialchars($post->autor) ?>
                                            </h5>
                                        </div>
                                        
                                        <p>
                                            <?= mb_strimwidth(
                                                strip_tags($post->conteudo),
                                                0,
                                                120,
                                                '...'
                                            ) ?>
                                        </p>
                                        
                                    </div>
                                    
                                    <a
                                        href="/postagem?id=<?= $post->id ?>"
                                        class="lermais-botao"
                                        >
                                        Ler mais
                                   </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Setas e paginacao -->

                    <div class="navegacao-posts-relacionados">
                        <div class="nav-arrow arrow-left posts-relacionado-pokeball" id="seta-esquerda"><</div>
                        <div class="nav-arrow arrow-right posts-relacionado-pokeball" id="seta-direita">></div>
                    </div>
                </div>

            <?php else: ?>

                <div class="sem-posts-relacionados">
                    <h3>Nenhum post relacionado encontrado.</h3>
                    <p>Este conteúdo ainda não possui outras publicações da mesma categoria.</p>
                </div>
                
            <?php endif; ?>

        </div>        
    </main>
    <?php require "footer.view.php"?>
</body>
<script src="../../../public/js/pagina-de-visualizacao.js"></script>
</html>