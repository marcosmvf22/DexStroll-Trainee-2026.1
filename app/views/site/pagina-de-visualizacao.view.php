<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  

    <!-- CSS Pagina de visualização individual -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/pagina-de-visualizacao.css">

    <!-- links da navbar -->
        <link rel="stylesheet" href="/public/css/navbar.css">
        <!-- Fonte -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!-- icones -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- CSS do footer -->
    <link rel="stylesheet" href="../../../public/css/footer.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <title><?=$publicacao->titulo?> - DexStroll</title>
</head>
<body>
         
    <?php require "navbar.view.php"?>
    <main class="pagina-de-visualizacao-unica">

        <!-- Titulo da pagina -->
        
        <div class="area-de-titulo">
            <img class="imagem-capa-post" src="<?= $publicacao->imagem ?>" alt="Imagem de capa do titulo">

            <div class="overlay-area-de-titulo"></div> 
            <div class="conteudo-do-titulo">
                
                <a  href="/postspage?categoria=<?= urlencode($publicacao->categoria) ?>" class="tag-categoria tag-cards">
                    <?= htmlspecialchars($publicacao->categoria) ?>
                </a>
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
                                            
                                            <a  href="/postspage?categoria=<?= urlencode($post->categoria) ?>" class="tag-categoria tag-cards">
                                                <?= htmlspecialchars($post->categoria) ?>
                                            </a>
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
                                        class="botão-ler-mais"
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
<!-- JS pagina de visualização -->
<script src="../../../public/js/pagina-de-visualizacao.js"></script>

<!-- JS navbar -->
  <script src="/public/js/navbar.js"></script>
</html>