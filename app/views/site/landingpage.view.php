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
    <!-- Links da landing page -->
    <link rel="stylesheet" href="/public/css/lp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- links da navbar -->
    <link rel="stylesheet" href="/public/css/navbar.css">
    <!-- Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- icones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- CSS do footer -->
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>Página inicial - DexStroll</title>
    <link rel="icon" type="image/png" href="/public/assets/favicon.png">
</head>

<body>
    <?php require 'navbar.view.php'; ?>
    <div class="hero-section-landing">
        <section>
            <h1>Explore e domine o mundo Pokémon com estratégia!</h1>
            <p>Descubra habilidades, matchups e decisões que realmente mudam suas batalhas.</p>
            <a href="#sobre-landing"><button>Saiba Mais</button></a>
        </section>

    </div>
    <section class="sobre-landing" id="sobre-landing">
        <h2>Mais que um blog!</h2>
        <div class="bloco-sobre-landing">
            <div class="sobre1">
                <img src="/public/assets/pokebola-100.png" alt="">
                <h3>Estratégia Aplicada</h3>
                <p class=>Entenda como usar habilidades, tipos e combinações na prática.</p>
            </div>
            <div class="sobre1">
                <img src="/public/assets/objetivo-90.png" width="100px" height="100px" alt="">
                <h3>Visão Estratégica</h3>
                <p>Aprenda diferentes formas de abordar a mesma batalha.</p>
            </div>
            <div class="sobre1">
                <img src="/public/assets/grupo-100.png" alt="">
                <h3>Crescimento Contínuo</h3>
                <p>Melhore com consistência através da prática e feedback.</p>
            </div>
        </div>
    </section>

    <section class="postagens-landing">
        <h2>Últimas postagens</h2>

        <div class="slider-landing">
            <button class="nav-arrow arrow-left" id="seta-esquerda" aria-label="Slide anterior">&lt;</button>
            <button class="nav-arrow arrow-right" id="seta-direita" aria-label="Próximo slide">&gt;</button>

            <div class="slider-conteudo-landing" id="slider-container">
                <?php foreach ($ultimasPublicacoes as $post): ?>
                    <div class="slider-item-landing">
                        <img src="<?= !empty($post->imagem) ? $post->imagem : '/public/assets/default-post.png' ?>"
                            alt="<?= htmlspecialchars($post->titulo) ?>">

                        <div class="data-tag">
                            <h6><?= date('d/m/Y', strtotime($post->data)) ?></h6>
                            <a href="/postspage?categoria=<?= urlencode($post->categoria) ?>"
                                class="tag-categoria tag-cards">
                                <?= htmlspecialchars($post->categoria) ?>
                            </a>

                        </div>

                        <h4><?= htmlspecialchars($post->titulo) ?></h4>

                        <div class="dados-autor-landing">
                            <h5><?= htmlspecialchars($post->autor) ?></h5>
                        </div>

                        <p><?= mb_strimwidth(strip_tags($post->conteudo), 0, 120, '...') ?></p>

                        <a href="/postagem?id=<?= $post->id ?>" class="botao-ler-mais">
                            Ler mais
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="politicas">
        <div>
            <h2 class="titulo-politicas">Sobre nós</h2>
        </div>
        <div class="bloco-politicas">
            <div class="card-politica">
                <i class="fa-solid fa-compass icon-politica"></i>
                <h3>Missão</h3>
                <p>
                    Nossa missão é reunir treinadores, fãs e curiosos em um só lugar, oferecendo notícias, guias,
                    curiosidades e estratégias para tornar a experiência no universo Pokémon mais divertida, acessível e
                    completa.
                </p>
            </div>
            <div class="card-politica">
                <i class="fa-solid fa-binoculars icon-politica"></i>
                <h3>Visão</h3>
                <p>
                    Ser uma das principais referências em conteúdo sobre Pokémon no Brasil, construindo uma comunidade
                    apaixonada, colaborativa e sempre atualizada, onde conhecimento, diversão e aprendizado caminham
                    juntos.
                </p>
            </div>
            <div class="card-politica">
                <i class="fa-solid fa-hand-fist icon-politica"></i>
                <h3>Valores</h3>
                <p>
                    Valorizamos a paixão pelo universo Pokémon, o respeito à comunidade e a produção de conteúdo
                    confiável e acessível. Incentivamos o aprendizado, a troca de experiências e a diversão em cada
                    etapa da jornada dos treinadores.
                </p>
            </div>

        </div>
    </section>
    <?php require 'footer.view.php'; ?>
</body>

<!-- JS navbar -->
<script src="/public/js/navbar.js"></script>

<!-- carrossel lp -->
<script src="/public/js/lp.js"></script>

</html>