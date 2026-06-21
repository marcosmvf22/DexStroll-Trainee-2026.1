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
    <link rel="stylesheet" href="/public/css/lp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>DexStroll</title>
</head>
<body>
    <?php require 'navbar.view.php'; ?>
    <div class="hero-section-landing">
        <section>
        <h1>Explore e domine o mundo Pokémon com estratégia!</h1>
        <p>Descubra habilidades, matchups e decisões que realmente mudam suas batalhas.</p>
        <button><a href="#sobre-landing">Saiba mais</a></button>
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
            <div class="slider-conteudo-landing">
                <!-- itens landing -->
                <?php foreach($ultimasPublicacoes as $post): ?>

                    <div class="slider-item-landing">

                        <img
                            src="<?= !empty($post->imagem)
                                ? $post->imagem
                                : '/public/assets/default-post.png' ?>"
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

                        <a
                            href="/postagem?id=<?= $post->id ?>"
                            class="botao-ler-mais"
                        >
                            Ler mais
                        </a>

                    </div>

                <?php endforeach; ?>
            </div>




            <div aria-hidden class="slider-conteudo-landing">
                <!-- itens landing -->
                <?php foreach($ultimasPublicacoes as $post): ?>

                    <div class="slider-item-landing">

                        <img
                            src="<?= !empty($post->imagem)
                                ? $post->imagem
                                : '/public/assets/default-post.png' ?>"
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

                        <a
                            href="/postagem?id=<?= $post->id ?>"
                            class="botao-ler-mais"
                        >
                            Ler mais
                        </a>

                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php require 'footer.view.php'; ?>
</body>
</html>