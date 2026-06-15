<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links -->
    <!-- <link rel="icon" href="./favicons/favicon-16x16.png"> -->
    <link rel="stylesheet" href="/public/css/pokedex.css">

    <!-- Main JS -->
    <title>Pokédex</title>
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
</body>
     <script defer src="/public/js/pokedex.js"></script>

</html>