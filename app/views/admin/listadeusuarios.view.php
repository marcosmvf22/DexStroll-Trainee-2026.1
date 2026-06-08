<!doctype html>
<!-- refateorei  essa desgraça,  bugou e tive que  restaurar  o backup,
 aí eu refatorei denovo, e saiu minhas antações, então vai no commit antigo se quiser  ver -->
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel - Usuários</title>

    <link rel="stylesheet" href="../../../public/css/listadeusuarios.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />


    <!-- CSS sidebar -->
     <link rel="stylesheet" href="../../../public/css/Sidebar.css">
 
  </head>
  <body>
    <? require 'Sidebar.view.php' ?>
    <main class="main-painel-usuarios">
    
      <div class="dashboard-container">
      
        <header class="header-dashboard">
          <h1>Usuários</h1>
          <h3><?= $totalUsuarios ?> usuários encontrados</h3>
        </header>

        <div class="card-tabela">
          <div class="topo-tabela">
            <button class="criar-usuario-admin" id="btn-abrir-modal">
              <span class="material-icons">person_add</span>
              Adicionar Usuário
            </button>
          </div>
          <div class="tabela-responsiva-container">
            <table class="tabela-admin">
              <thead>
                <tr class="cabecalho-tabela-admin">
                  <th>Usuário</th>
                  <th>Nome Completo</th>
                  <th>Email</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody id="corpo-tabela-usuarios">
                <?php foreach ($usuarios as $usuario) : ?>
                  <tr data-id="<?= $usuario->id ?>">
                    <td class="dado_id_admin">
                      <div style="display: flex; align-items: center; justify-content: flex-start; padding-left: 25px; gap: 12px;">
                        <img src="<?= $usuario->avatar ?: '/public/assets/default-avatar.png' ?>" class="mini-avatar-tabela" alt="Avatar">
                        <span><?= $usuario->username ?></span>
                      </div>
                    </td>
                    <td><?= $usuario->nome ?></td>
                    <td><?= $usuario->email ?></td>
                    <td class="celula-acoes-admin">
                      <button class="botao-acao" title="Visualizar"><span class="material-icons">visibility</span></button>
                      <button class="botao-acao" title="Editar"><span class="material-icons">edit</span></button>
                      <button class="botao-acao botao-deletar btn-deletar-linha" title="Deletar"><span class="material-icons">delete</span></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            
            <?php require 'paginacao.view.php' ?>
          </div>
        </div>
      </div>
      


      <!-- aqui modal de criar -->
      <div id="modal-usuario" class="modal-container-flutuante">
        <div class="modal-card-caixa">
          
          <div class="modal-header-local">
            <h2>Cadastrar Novo Usuário</h2>
            <button type="button" class="botao-fechar-x" id="btn-fechar-x">
              <span class="material-icons">close</span>
            </button>
          </div>
          
          <form id="form-novo-usuario" action="/usuarios/criar" method="POST" enctype="multipart/form-data">
            
            <div class="container-foto-upload">
              <div class="wrapper-avatar">
                <img src="/public/assets/default-avatar.png" id="avatar-clicavel" alt="Avatar">
                <div class="badge-upload">
                  <span class="material-icons">arrow_upward</span>
                </div>
              </div>
              <input type="file" name="avatar" id="input-avatar" accept="image/*" style="display: none;">
            </div>

            <div class="grupo-campo">
              <label for="input-username">Username</label>
              <input type="text" name="username" id="input-username" required placeholder="Digite o username">
            </div>

            <div class="grupo-campo">
              <label for="input-nome">Nome Completo</label>
              <input type="text" name="nome" id="input-nome" required placeholder="Digite seu nome completo">
            </div>

            <div class="grupo-campo">
              <label for="input-email">Email</label>
              <input type="email" name="email" id="input-email" required placeholder="email@mail.com">
            </div>

            <div class="grupo-campo">
              <label for="input-senha">Senha</label>
              <input type="password" name="senha" id="input-senha" required placeholder="Digite sua senha">
            </div>

            <div class="modal-rodape-botoes">
              <button type="button" class="cancelarBotaoModal" id="btn-cancelar">Cancelar</button>
              <button type="submit" class="enviarBotaoModal">Salvar Usuário</button>
            </div>
          </form>
        </div>
      </div>
      
      <!-- modal de visualizar usuario-->
      <div id="modal-visualizar-usuario" class="modal-container-flutuante">
        <div class="modal-card-caixa">
          <div class="modal-header-local">
            <h2>Visualizar Usuário</h2>
            <button type="button" class="botao-fechar-x" id="btn-fechar-visualizar-x">
              <span class="material-icons">close</span>
            </button>
          </div>
          <div id="form-visualizar-usuario">
            <div class="container-foto-upload" style="margin-bottom: 20px;">
              <div class="wrapper-avatar" style="position: relative; display: inline-block;">
                <img src="/public/assets/default-avatar.png" id="view-avatar" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer; object-fit: cover; border: 2px solid var(--azul-marinho);"> 
              </div>
            </div>
            <div class="grupo-campo">
              <label>ID</label>
              <input type="text" id="view-id" readonly>
            </div>
            <div class="grupo-campo">
              <label>Username</label>
              <input type="text" id="view-username" readonly>
            </div>
            <div class="grupo-campo">
              <label>Nome Completo</label>
              <input type="text" id="view-nome" readonly>
            </div>
            <div class="grupo-campo">
              <label>Email</label>
              <input type="text" id="view-email" readonly>
            </div>
          </div>
        </div>
      </div>

      <!-- modal de editar usuario -->
      <div id="modal-editar-usuario" class="modal-container-flutuante">
        <div class="modal-card-caixa">
          <div class="modal-header-local">
            <h2>Editar Usuário</h2>
            <button type="button" class="botao-fechar-x" id="btn-fechar-editar-x">
              <span class="material-icons">close</span>
            </button>
          </div>
          <form id="form-editar-usuario" action="/usuarios/atualizar" method="POST" enctype="multipart/form-data">
            <!-- esse input hidden pra usar o ID de referencia -->
            <input type="hidden" name="id" id="edit-id">
            <input type="hidden" id="edit-email-original"> <!-- Para saber quem editar -->
            <div class="container-foto-upload" style="margin-bottom: 20px;">
              <div class="wrapper-avatar" style="position: relative; display: inline-block;">
                <img src="/public/assets/default-avatar.png" id="edit-avatar-clicavel" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer; object-fit: cover; border: 2px solid var(--azul-marinho);"> 
                <div class="badge-upload" style="pointer-events: none;">
                  <span class="material-icons">arrow_upward</span>
                </div>
              </div>
              <input type="file" id="edit-input-avatar" name="avatar" accept="image/*" style="display: none;">
            </div>
            <div class="grupo-campo">
              <label>Username</label>
              <input type="text" name="username" id="edit-input-username" required>      
            </div>
            <div class="grupo-campo">
              <label>Nome Completo</label>
              <input type="text" name="nome" id="edit-input-nome" required> 
            </div>
            <div class="grupo-campo">
              <label>Email</label>
              <input type="email" name="email" id="edit-input-email" required>
            </div>
            <div class="grupo-campo">
              <label>Nova senha</label>
              <input type="password" name="senha" id="edit-input-senha">
            </div>
            <div class="modal-rodape-botoes">
              <button type="button" class="cancelarBotaoModal" id="btn-cancelar-editar">Cancelar</button>
              <button type="submit" class="enviarBotaoModal">Salvar Alterações</button>
            </div>
          </form>
        </div>
      </div>

      <!-- modal de excluir -->
      <div class="modal-container-flutuante" id="modal-excluir-usuario">
        <div class="modalExcluirUsuario">
          <h3 class="titulo-modal-excluir">Excluir Usuário</h3>
          <hr class="linha-separadora-modal-excluir">
          <div class="container-icone-modal-excluir">
            <span class="material-icons icone-alerta-modal-excluir">error</span>
          </div>
        
          <p class="descricao-modal-excluir">Essa ação é irreversível. Você tem certeza que deseja excluir esse usuário?</p>

          <form action="/usuarios/deletar" method="POST">

            <input type="hidden" name="id" id="delete-id">

            <div class="botoesModalExcluirUsuario">
              <button type="button" class="cancelarBotaoModalDeExclusao" id="btn-cancelar-excluir">Cancelar</button>
              <button type="submit" class="excluirBotaoModal" id="btn-confirmar-excluir">Excluir</button>
            </div>

          </form>
        </div>
      </div>

    </main>
  </body>

  <!-- JS sidebar -->
  <script src="/public/js/Sidebar.js"></script>
  <!-- JS Lista de Usuarios -->
  <script src="../../../public/js/listadeusuarios.js"></script>
</html>