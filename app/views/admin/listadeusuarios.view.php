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
  </head>
  <body class="pegatudo">
    <? require 'Sidebar.view.php' ?>
  <main class="main-painel-usuarios">
    
    <div class="dashboard-container">
      
      <header class="header-dashboard">
        <h1>Lista de Usuários</h1>
        <h3>xx usuários encontrados</h3>
      </header>

      <div class="card-tabela">
        <div class="topo-tabela">
          <button class="criar-usuario-admin" id="btn-abrir-modal">
            <span class="material-icons" style="vertical-align: middle; font-size: 18px; margin-right: 6px;">person_add</span>
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
          <tbody id="corpo-tabela-usuarios"></tbody>
        </table>
      </div>
      </div> 

      <div class="paginacao">
        <button class="btn-pag">&lt;</button>
        <button class="btn-pag ativo">1</button>
        <button class="btn-pag">&gt;</button>
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
        
        <form id="form-novo-usuario">
          
          <div class="container-foto-upload">
            <div class="wrapper-avatar" id="avatar-clicavel">
              <span class="material-icons icone-avatar-padrao">account_circle</span>
              <div class="badge-upload">
                <span class="material-icons">arrow_upward</span>
              </div>
            </div>
            <input type="file" id="input-avatar" accept="image/*" style="display: none;">
          </div>

          <div class="grupo-campo">
            <label for="input-username">Username</label>
            <input type="text" id="input-username" required placeholder="Ex: Marcos">
          </div>

          <div class="grupo-campo">
            <label for="input-nome">Nome Completo</label>
            <input type="text" id="input-nome" required placeholder="Digite seu nome completo">
          </div>

          <div class="grupo-campo">
            <label for="input-email">Email</label>
            <input type="email" id="input-email" required placeholder="email@mail.com">
          </div>

          <div class="modal-rodape-botoes">
            <button type="button" class="cancelarBotaoModal" id="btn-cancelar">Cancelar</button>
            <button type="submit" class="enviarBotaoModal">Salvar Usuário</button>
          </div>
        </form>

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
    <form id="form-editar-usuario">
      <input type="hidden" id="edit-email-original"> <!-- Para saber quem editar -->
      <div class="container-foto-upload" style="margin-bottom: 20px;">
        <div class="wrapper-avatar" style="position: relative; display: inline-block;">
          <img src="/public/assets/default-avatar.png" id="edit-avatar-clicavel" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; cursor: pointer; object-fit: cover; border: 2px solid var(--azul-marinho);"> 
          <div class="badge-upload" style="pointer-events: none;">
            <span class="material-icons">arrow_upward</span>
          </div>
        </div>
        <input type="file" id="edit-input-avatar" accept="image/*" style="display: none;">
      </div>
      <div class="grupo-campo">
        <label>Username</label>
        <input type="text" id="edit-input-username" required>
      </div>
      <div class="grupo-campo">
        <label>Nome Completo</label>
        <input type="text" id="edit-input-nome" required>
      </div>
      <div class="grupo-campo">
        <label>Email</label>
        <input type="email" id="edit-input-email" required>
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

        <div class="botoesModalExcluirUsuario">
          <button type="button" class="cancelarBotaoModalDeExclusao" id="btn-cancelar-excluir">Cancelar</button>
          <button type="button" class="excluirBotaoModal" id="btn-confirmar-excluir">Excluir</button>
        </div>
      </div>
    </div>
</main>
    <script src="../../../public/js/listadeusuarios.js"></script>
  </body>
</html>