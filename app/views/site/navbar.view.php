<header class="header-nav">
    <nav>
        <div class="box1-nav">
            <div class="wrapperbarra">
                <div class="logo-nav">
                    <a href="/">
                        <img class="logo-nav" src="/public/assets/Logo-nav.png" alt="">
                    </a>
                </div>
                <div class="box-pesquisa-nav">
                    <form action="/postspage" method="GET" class="pesquisapost">
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
                </div>
            </div>
            <div class="botoes-nav">
                <a href="/" class="botao-home-nav">Home</a>

                <a href="/postspage" class="botao-publicacoes-nav">Publicações</a>
                <a href="/pokedex"  class="botao-publicacoes-nav">Pokédex</button>
                <a href="/login" class="botao-login-nav">Login</a>
                
            </div>
            <div class="bloco-icone-menu-nav">
                <button onclick="menuShowNav()"><i id="icone-menu-nav" class="fa-solid fa-bars"></i></button>
            </div>
        </div>

        <!--<div class="box2-nav">
            <span class="line-nav"></span>
        </div> -->
        
    </nav>
    <div class="mobile-menu-nav">
        <ul>
            <li class="mobile-item-nav"> <a href="" class="mobile-link-nav"><i class="fa-solid fa-house icone-mobile-esquerda-nav"></i>Home<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            <li class="mobile-item-nav"> <a href="" class="mobile-link-nav"><i class="fa-solid fa-file icone-mobile-esquerda-nav"></i>Publicações<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            <li class="mobile-item-nav"> <a href="" class="mobile-link-nav"><i class="fa-solid fa-user icone-mobile-esquerda-nav"></i>Login<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
        </ul>
    </div>
</header>