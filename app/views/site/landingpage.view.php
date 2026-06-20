<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links da landing page -->
    <link rel="stylesheet" href="/public/css/lp.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    
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

    <section class="politicas">
        <div>
            <h2 class="titulo-politicas">Sobre</h2>
        </div>
        <div class="bloco-politicas">
            <div class="card-politica">
                <h3>Missão</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam quia, quae dolorem rerum, architecto incidunt animi velit laboriosam sint provident laborum consectetur, natus repellat. Numquam id molestiae quaerat dignissimos similique.
                    Eius, velit nihil sit sed harum voluptate nostrum impedit incidunt illum libero esse dolorem saepe non repellat, eligendi voluptatum sequi minus quas cupiditate nulla animi necessitatibus eum! Similique, qui tempora.
                    Voluptas eum nihil magnam labore voluptatem veritatis exercitationem culpa temporibus voluptates quia omnis quis accusantium ab consectetur impedit harum, illum natus, quibusdam excepturi non animi fugiat distinctio accusamus. Vitae, officia.
                </p>
            </div>
            <div class="card-politica">
                <h3>Visão</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam quia, quae dolorem rerum, architecto incidunt animi velit laboriosam sint provident laborum consectetur, natus repellat. Numquam id molestiae quaerat dignissimos similique.
                    Eius, velit nihil sit sed harum voluptate nostrum impedit incidunt illum libero esse dolorem saepe non repellat, eligendi voluptatum sequi minus quas cupiditate nulla animi necessitatibus eum! Similique, qui tempora.
                    Voluptas eum nihil magnam labore voluptatem veritatis exercitationem culpa temporibus voluptates quia omnis quis accusantium ab consectetur impedit harum, illum natus, quibusdam excepturi non animi fugiat distinctio accusamus. Vitae, officia.
                </p>
            </div>
            <div class="card-politica">
                <h3>Valores</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam quia, quae dolorem rerum, architecto incidunt animi velit laboriosam sint provident laborum consectetur, natus repellat. Numquam id molestiae quaerat dignissimos similique.
                    Eius, velit nihil sit sed harum voluptate nostrum impedit incidunt illum libero esse dolorem saepe non repellat, eligendi voluptatum sequi minus quas cupiditate nulla animi necessitatibus eum! Similique, qui tempora.
                    Voluptas eum nihil magnam labore voluptatem veritatis exercitationem culpa temporibus voluptates quia omnis quis accusantium ab consectetur impedit harum, illum natus, quibusdam excepturi non animi fugiat distinctio accusamus. Vitae, officia.
                </p>
            </div>

        </div>
    </section>
    <?php require 'footer.view.php'; ?>
</body>

<!-- JS navbar -->
<script src="/public/js/navbar.js"></script>
</html>