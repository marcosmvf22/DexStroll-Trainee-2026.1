<header class="header-nav">
    <nav>
        <div class="box1-nav">
            <div class="wrapperbarra">
                <div class="logo-nav">
                    <a href="/">
                        <img class="logo-nav" src="../../../public/assets/dexstroll-logo.png" alt="">
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
                <a href="/pokedex"  class="botao-publicacoes-nav">Pokédex</a>
                
                <?php if (isset($_SESSION['id'])): ?>
                    <?php if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] === 'admin'): ?>
                        <a href="/dashboard" class="botao-publicacoes-nav">Dashboard</a>
                    <?php endif; ?>

                    <form action="/logout" method="POST" style="display: inline;">
                        <button type="submit" class="botao-login-nav">Sair</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="botao-login-nav">Login</a>
                <?php endif; ?>
                
            </div>
            <div class="bloco-icone-menu-nav">
                <button onclick="menuShowNav()"><i id="icone-menu-nav" class="fa-solid fa-bars"></i></button>
            </div>
        </div>
        
    </nav>
    <div class="mobile-menu-nav">
        <ul>
            <li class="mobile-item-nav"> <a href="/" class="mobile-link-nav"><i class="fa-solid fa-house icone-mobile-esquerda-nav"></i>Home<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            <li class="mobile-item-nav"> <a href="/postspage" class="mobile-link-nav"><i class="fa-solid fa-file icone-mobile-esquerda-nav"></i>Publicações<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            <li class="mobile-item-nav"> <a href="/pokedex" class="mobile-link-nav"><i class="fa-solid fa-gamepad icone-mobile-esquerda-nav"></i>Pokédex<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            
            <?php if (isset($_SESSION['id'])): ?>
                <?php if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] === 'admin'): ?>
                    <li class="mobile-item-nav"> <a href="/dashboard" class="mobile-link-nav"><i class="fa-solid fa-gauge icone-mobile-esquerda-nav"></i>Painel Admin<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
                <?php endif; ?>
                
                <li class="mobile-item-nav">
                    <form action="/logout" method="POST" id="form-logout-mobile">
                        <a href="#" onclick="document.getElementById('form-logout-mobile').submit(); return false;" class="mobile-link-nav" style="color: #ff4d4d;">
                            <i class="fa-solid fa-right-from-bracket icone-mobile-esquerda-nav"></i>Sair<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i>
                        </a>
                    </form>
                </li>
            <?php else: ?>
                <li class="mobile-item-nav"> <a href="/login" class="mobile-link-nav"><i class="fa-solid fa-user icone-mobile-esquerda-nav"></i>Login<i class="fa-solid fa-arrow-right icone-mobile-direita-nav"></i></a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>