<!-- Botão para fechar sidebar -->
<div class="habilitar_sidebar">
     <button class="toggle-sidebar" type="button">
     <i class="material-icons">menu</i>
    </button>
</div>

<nav class="sidebar">
    <!-- botão para fechar e abrir sidebar -->
    <div class="sidebar-topo">

         <!-- Perfil de usuario -->
        <div class="sidebar-perfilUsuario">
            <img class="imagem-usuario-sidebar" src="<?= $usuarioLogado->avatar ?>" alt="imagem de perfil">
            <div class="info-perfilUsuario">
                <p><?= $usuarioLogado->username ?></p>
                <p><?= $usuarioLogado->email ?></p>
            </div>
        </div>
    </div>

    <!-- Menus para outras paginas administrativas -->
    <div class="sidebar-menus">
        <ul>
            <!-- Menu home -->
            <li>
                <a href="/" class="sidebar-menus-links">
                    <i class="material-icons">home</i>
                    <span class="descricao-menus">Pagina inicial</span>
                </a>
            </li>

            <!-- Menu deshboard -->
                <li>
                    
                    <a href="/dashboard" class="sidebar-menus-links">
                        <i class="material-icons">dashboard</i>
                        <span class="descricao-menus">Dashboard</span>
                    </a>
 
                </li>
            <!-- Menu lista de usuarios -->
            <li>
                <a href="/usuarios" class="sidebar-menus-links">
                    <i class="material-icons">group</i>
                    <span class="descricao-menus">Lista de Usuários</span>
                </a>
            </li>

            <!-- Menu lista de posts -->
            <li>
                <a href="/listadeposts" class="sidebar-menus-links">
                    <i class="material-icons">view_list</i>
                    <span class="descricao-menus">Lista de Posts</span>
                </a>
            </li>  
        </ul>
    </div>

    <!-- Perfil do usuario e botão de logout -->
    <div class="sidebar-bottom">

        <!-- Perfil de usuario -->
       <div class="sidebar-perfilUsuario">
            <img class="imagem-usuario-sidebar" src="<?= $usuarioLogado->avatar ?>" alt="imagem de perfil">
            <div class="info-perfilUsuario">
                <p><?= $usuarioLogado->username ?></p>
                <p><?= $usuarioLogado->email ?></p>
            </div>
        </div>

        <!-- Botão de logout -->
        <div class="sidebar-logout">
            <form action="/logout" method="POST" class="form-sidebar">
                <button class="botao-logout-sidebar">
                    <i class="material-icons">logout</i>
                    <span class="descricao-logout">Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>