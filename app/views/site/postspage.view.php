<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/postspage.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
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
    
    <title>DexStroll Publicações</title>
  </head>
  <body>
    <?php require 'navbar.view.php'; ?>

    <main>
      <h1 class="postpagetitle">Últimas Postagens</h1>

      <section class="grade_posts">
        <?php foreach ($publicacoes as $post) : ?>
          <article class="publicacao">
            <div class="fotodopost">
              <img 
                src="<?= !empty($post->imagem) ? $post->imagem : '/public/assets/default-post.png' ?>" 
                alt="Capa da publicação" 
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50px;"
              >
            </div>
            
            <div class="conteudopost">
              <time class="posts-card-data" datetime="<?= $post->data ?>">
                <?= date('d/m/Y', strtotime($post->data)) ?>
              </time>
              
              <h2 class="titulopost"><?= htmlspecialchars($post->titulo) ?></h2>
              <p class="nomeautorpost">Autor: <?= htmlspecialchars($post->autor) ?></p>

              <p class="manchetedopost">
                <?= mb_strimwidth(strip_tags($post->conteudo), 0, 100, "...") ?>
              </p>
              
              <a href="/postagem?id=<?= $post->id ?>" class="lermais-botao">Ler Mais</a>
            </div>
          </article>
        <?php endforeach; ?>
      </section>

      <?php require 'paginacao_postagens.view.php'; ?>

      <!-- <div class="paginacao-posts">
        <button class="posts-pokeball prev"><</button>
        <button class="posts-pokeball">1</button>
        <button class="posts-pokeball clicada">2</button>
        <button class="posts-pokeball">3</button>
        <button class="posts-pokeball dots">...</button>
        <button class="posts-pokeball next">></button>
      </div> -->
    </main>
    
    <?php require 'footer.view.php'; ?>

  </body>
  <!-- JS pagina de ultimas postagens -->
  <script src="../../../public/js/postspage.js"></script>

  <!-- JS navbar -->
  <script src="/public/js/navbar.js"></script>
</html>
