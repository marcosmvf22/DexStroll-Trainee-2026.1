//eu removi os comentários, se quiser ler vai no comit anterior,
//porém, eu sem querer troquei esse let abaixo por um const e me tomou quase 2 horas de sono  pra perceber
//o  motivo de nao estar deletando
//o codigo estava cheio de  anotações no commit anterior, do que cada função fazia e cada inserção/reorganização
// de array.
let listaUsuarios = [
  {
    username: "Usuarioexemplo1",
    nome: "Nome Completo Um",
    email: "usuario1@email.com",
  },
  {
    username: "Usuarioexemplo2",
    nome: "Nome Completo Dois",
    email: "usuario2@email.com",
  },
  {
    username: "nomedeusuario",
    nome: "Nome Completo Três",
    email: "usuario3@email.com",
  },
];

let usuarioParaDeletar = null;

const corpoTabela = document.getElementById("corpo-tabela-usuarios");

function renderizarTabela() {
  if (corpoTabela) {
    corpoTabela.innerHTML = "";
    listaUsuarios.forEach((usuario) => {
      const linhaHTML = `  
        <tr>
          <td class="dado_id_admin">${usuario.username}</td>
          <td>${usuario.nome}</td>
          <td>${usuario.email}</td>
          <td class="celula-acoes-admin">
            <button class="botao-acao" title="Visualizar">
              <span class="material-icons">visibility</span>
            </button>
            <button class="botao-acao" title="Editar">
              <span class="material-icons">edit</span>
            </button>
            <button class="botao-acao botao-deletar btn-deletar-linha" title="Deletar">
              <span class="material-icons">delete</span>
            </button>
          </td>
        </tr>
      `;
      corpoTabela.innerHTML += linhaHTML;
    });
  }
}

renderizarTabela();

const modal = document.getElementById("modal-usuario");
const btnAbrir = document.getElementById("btn-abrir-modal");
const btnFecharX = document.getElementById("btn-fechar-x");
const btnCancelar = document.getElementById("btn-cancelar");
const formulario = document.getElementById("form-novo-usuario");
const avatarClicavel = document.getElementById("avatar-clicavel");
const inputAvatarReal = document.getElementById("input-avatar");

const modalExclusao = document.getElementById("modal-excluir-usuario");
const btnCancelarExclusao = document.getElementById("btn-cancelar-excluir");
const btnConfirmarExclusao = document.getElementById("btn-confirmar-excluir");

if (btnAbrir && modal) {
  btnAbrir.addEventListener("click", () => {
    modal.style.display = "flex";
  });
}

const fecharOModal = () => {
  if (modal) modal.style.display = "none";
};

if (btnFecharX) btnFecharX.addEventListener("click", fecharOModal);
if (btnCancelar) btnCancelar.addEventListener("click", fecharOModal);

if (avatarClicavel && inputAvatarReal) {
  avatarClicavel.addEventListener("click", () => {
    inputAvatarReal.click();
  });
}

if (formulario) {
  formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const novoUsuario = {
      username: document.getElementById("input-username").value,
      nome: document.getElementById("input-nome").value,
      email: document.getElementById("input-email").value,
    };

    listaUsuarios.unshift(novoUsuario);
    renderizarTabela();
    formulario.reset();
    fecharOModal();
  });
}

if (corpoTabela && modalExclusao) {
  corpoTabela.addEventListener("click", (evento) => {
    const botaoLixeira = evento.target.closest(".btn-deletar-linha");

    if (botaoLixeira) {
      const linha = botaoLixeira.closest("tr");
      const usernameId = linha.querySelector(".dado_id_admin").textContent.trim();

      usuarioParaDeletar = usernameId;
      modalExclusao.style.display = "flex";
    }
  });
}

if (btnCancelarExclusao && modalExclusao) {
  btnCancelarExclusao.addEventListener("click", () => {
    //esse null abaixo, pra caso cancele, nao continuar na variavel e correr o risco
    //de apagar sem intenção nofuturo
    usuarioParaDeletar = null;
    modalExclusao.style.display = "none";
  });
}
//tem que confirmar pq senão apaga sem querer, e também tem  que filtrar o ID,
//pq senao apaga errado
if (btnConfirmarExclusao && modalExclusao) {
  btnConfirmarExclusao.addEventListener("click", () => {
    if (usuarioParaDeletar !== null) {
      listaUsuarios = listaUsuarios.filter((u) => u.username !== usuarioParaDeletar);
      //esse filter !==, é um filtro reverso, achei  mais seguro (fiquei com preguiça naverdade), ele é tipo o oposto
      //de selecionar  o  usuario pra apagar, é selecionar o que vai manter, muito pika
      //obs2:pensei agora q se tiver  muito usuario talvez pese o site, vou ponderar, pois vai 
      //passar  usuario por  usuario pra  saber se vai manter ou  nao

      //obs3:  pesquisei um cado e parece que não pesa, por mais que 
      //esteja construindo o array inteiro. poderia usar splice pelo que vi na mozilla, mas agora vai  ficar asism mesmo.
      usuarioParaDeletar = null;
      renderizarTabela();
      modalExclusao.style.display = "none";
    }
  });
}