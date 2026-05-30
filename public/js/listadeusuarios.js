//eu removi os comentários, se quiser ler vai no comit anterior,
//porém, eu sem querer troquei esse let abaixo por um const e me tomou quase 2 horas de sono  pra perceber
//o  motivo de nao estar deletando
//o codigo estava cheio de  anotações no commit anterior, do que cada função fazia e cada inserção/reorganização
// de array.
let listaUsuarios = [
  {
    avatar: "/public/assets/default-avatar.png",
    username: "Usuarioexemplo1",
    nome: "Nome Completo Um",
    email: "usuario1@email.com",
  },
  {
    avatar: "/public/assets/default-avatar.png",
    username: "Usuarioexemplo2",
    nome: "Nome Completo Dois",
    email: "usuario2@email.com",
  },
  {
    avatar: "/public/assets/default-avatar.png", 
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
<td class="dado_id_admin">
<div style="display: flex; align-items: center; justify-content: center; gap: 12px;"><img src="${usuario.avatar ? usuario.avatar : '/public/assets/default-avatar.png'}" class="mini-avatar-tabela" alt="Avatar">
<span>${usuario.username}</span>
            </div>
          </td>
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

const modalEditar = document.getElementById("modal-editar-usuario");
const btnFecharEditarX = document.getElementById("btn-fechar-editar-x");
const btnCancelarEditar = document.getElementById("btn-cancelar-editar");
const formEditar = document.getElementById("form-editar-usuario");

const editAvatarClicavel = document.getElementById("edit-avatar-clicavel");
const editInputAvatar = document.getElementById("edit-input-avatar");

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
      const emailId = linha.cells[2].textContent.trim();
      usuarioParaDeletar = emailId;
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
      listaUsuarios = listaUsuarios.filter((u) => u.email !== usuarioParaDeletar);
      //troquei acima pra usar o email ao inves de username
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

//modal de editar o usuario, senão não ia dar pra alterar usuario 
//igual a steam que nao deixa alterar a desgraça do login
corpoTabela.addEventListener("click", (evento) => {
  const botaoEditar = evento.target.closest('[title="Editar"]');
  
  if (botaoEditar) {
    const linha = botaoEditar.closest("tr");
    const username = linha.cells[0].textContent;
    const nome = linha.cells[1].textContent;
    const email = linha.cells[2].textContent;


    //igual o outro, injeta igual vacina na tabela
    document.getElementById("edit-email-original").value = email;
    document.getElementById("edit-input-username").value = username;
    document.getElementById("edit-input-nome").value = nome;
    document.getElementById("edit-input-email").value = email;

    modalEditar.style.display = "flex";
  }
});
formEditar.addEventListener("submit", (e) => {
  e.preventDefault();
const emailOriginal = document.getElementById("edit-email-original").value;  
//aqui eu coloquei o filtro pra buscar pelo email ao invés do  usuario para poder  editar usuario
const index = listaUsuarios.findIndex(u => u.email === emailOriginal);  if (index !== -1) {
    listaUsuarios[index].username = document.getElementById("edit-input-username").value;
    listaUsuarios[index].nome = document.getElementById("edit-input-nome").value;
  }

  renderizarTabela();
  modalEditar.style.display = "none";
});

//nao tava fechando, aí fui olhar os outros modais e lembrei que tem botar isso aqui:
const fecharModalEditar = () => { modalEditar.style.display = "none"; };
if (btnFecharEditarX) btnFecharEditarX.addEventListener("click", fecharModalEditar);
if (btnCancelarEditar) btnCancelarEditar.addEventListener("click", fecharModalEditar);

//esqueci da  foto
if (editAvatarClicavel && editInputAvatar) {
  editAvatarClicavel.addEventListener("click", () => {
    editInputAvatar.click();
  });



  editInputAvatar.addEventListener("change", (evento) => {
    const ficheiro = evento.target.files[0];
    
    if (ficheiro) {
      const leitor = new FileReader();
      
      leitor.onload = function(e) {
        
        
        editAvatarClicavel.src = e.target.result;
      };
      
      leitor.readAsDataURL(ficheiro);
    }
  });
}

//boa noite, eu acho  que ta tudo certo,  consegui  remover alguns bugs, meu teclado ainda
// ta dando espaço duplo as vezes, e isso me incomoda sinceramente.
//devo reprovar em 7 de 8 disciplinas, mas isso é porque tranquei uma  delas;
//dito  isso gostei do JS, parce bastante o java normal, porém meio fresco em algumas coisas
//e  mais  facil em outras, talvez eu vá pra essa área