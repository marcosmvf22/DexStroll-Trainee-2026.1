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
    <!-- Links -->
    <!-- <link rel="icon" href="./favicons/favicon-16x16.png"> -->
    <link rel="stylesheet" href="/public/css/pokedex.css">

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

    <title>Pokédex - DexStroll</title>
    <link rel="icon" type="image/png" href="/public/assets/favicon.png">
</head>
<body>
    
 <?php require "navbar.view.php"?>



    <main>
        <img src="#" alt="pokemon" class="pokemon_image">

        <h1 class="pokemon_main_data">
            <span class="pokemon_number"></span> -
            <span class="pokemon_name"></span>
        </h1>

        <form class="barra_busca">
            <input type="search" class="input_search" placeholder="Nome ou ID" required>
        </form>

        <!-- botões avançar e voltar -->
        <div class="buttons">
            <button class="button btn-prev">&lt</button>
            <button class="button btn-next">&gt</button>
        </div>

        <div class="pokemon_aditional_data">
            <span class="pokemon_height"></span><br>
            <span class="pokemon_weight"></span><br>
            <span class="pokemon_evolution"></span>
            
            <!-- Condições de encontro -->
            <span class="pokemon_encounters"></span>
            <span class="pokemon_methods"></span>
            <span class="pokemon_conditions"></span>

            <!-- Taxa de captura, pra cálculo da pokébola adequada -->
            <span class="pokemon_capture_rate"></span>
        </div>
        
        <!-- Fundo da pokédex -->
        <img src="/public/assets/pokédex_lisa.png" alt="pokedex" class="pokedex">

    </main>
    <? require 'footer.view.php'?>
</body>
    <!-- Main JS -->
    <script defer src="/public/js/pokedex.js"></script>

    <!-- JS navbar -->
    <script src="/public/js/navbar.js"></script>
</html>