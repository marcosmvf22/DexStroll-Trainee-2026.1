
let usuarioParaDeletar = null;
const corpoTabela = document.getElementById("corpo-tabela-usuarios");
// tem algumas  coisas aqui que estão confusas, e nao sei se  removi tudo de  inutil  no código depois
// que  comecei a migrar  pro controller
//se precisar  de explicação sobre cada funcao, vai nos  commits anteriores
// que tem mais comentarios sobre cada  coisa

const modal = document.getElementById("modal-usuario");
const btnAbrir = document.getElementById("btn-abrir-modal");
const btnFecharX = document.getElementById("btn-fechar-x");
const btnCancelar = document.getElementById("btn-cancelar");
const formulario = document.getElementById("form-novo-usuario");

const modalExclusao = document.getElementById("modal-excluir-usuario");
const btnCancelarExclusao = document.getElementById("btn-cancelar-excluir");
const btnConfirmarExclusao = document.getElementById("btn-confirmar-excluir");

const modalEditar = document.getElementById("modal-editar-usuario");
const btnFecharEditarX = document.getElementById("btn-fechar-editar-x");
const btnCancelarEditar = document.getElementById("btn-cancelar-editar");
const formEditar = document.getElementById("form-editar-usuario");

const modalVisualizar = document.getElementById("modal-visualizar-usuario");
const btnFecharVisualizarX = document.getElementById("btn-fechar-visualizar-x");

const avatarClicavel = document.getElementById("avatar-clicavel");
const inputAvatarReal = document.getElementById("input-avatar");
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
  avatarClicavel.addEventListener("click", () => inputAvatarReal.click());
  
  inputAvatarReal.addEventListener("change", (evento) => {
    const ficheiro = evento.target.files[0];
    if (ficheiro) {
      const leitor = new FileReader();
      leitor.onload = function(e) {
        avatarClicavel.src = e.target.result;
      };
      leitor.readAsDataURL(ficheiro);
    }
  });
}

if (corpoTabela && modalVisualizar) {
  corpoTabela.addEventListener("click", (evento) => {
    const botaoVisualizar = evento.target.closest('[title="Visualizar"]');
    if (botaoVisualizar) {
      const linha = botaoVisualizar.closest("tr");

      const id = linha.dataset.id;
      const username = linha.cells[0].querySelector("span").textContent.trim();
      const nome = linha.cells[1].textContent.trim();
      const email = linha.cells[2].textContent.trim();
      const avatar = linha.querySelector(".mini-avatar-tabela")?.src || "/public/assets/default-avatar.png";

      document.getElementById("view-id").value = id;
      document.getElementById("view-username").value = username;
      document.getElementById("view-nome").value = nome;
      document.getElementById("view-email").value = email;
      document.getElementById("view-avatar").src = avatar;
      modalVisualizar.style.display = "flex";
    }
  });
}

const fecharModalVisualizar = () => { if (modalVisualizar) modalVisualizar.style.display = "none"; };
if (btnFecharVisualizarX) btnFecharVisualizarX.addEventListener("click", fecharModalVisualizar);

if (corpoTabela && modalExclusao) {
  corpoTabela.addEventListener("click", (evento) => {
    const botaoLixeira = evento.target.closest(".btn-deletar-linha");
    if (botaoLixeira) {
      const linha = botaoLixeira.closest("tr");

      usuarioParaDeletar = linha.dataset.id;

      document.getElementById("delete-id").value = usuarioParaDeletar;

      modalExclusao.style.display = "flex";
    }
  });
}

if (btnCancelarExclusao && modalExclusao) {
  btnCancelarExclusao.addEventListener("click", () => {
    usuarioParaDeletar = null;
    modalExclusao.style.display = "none";
  });
}

if (corpoTabela && modalEditar) {
  corpoTabela.addEventListener("click", (evento) => {
    const botaoEditar = evento.target.closest('[title="Editar"]');
    if (botaoEditar) {
      const linha = botaoEditar.closest("tr");

      const id = linha.dataset.id;
      const username = linha.cells[0].textContent.trim();
      const nome = linha.cells[1].textContent.trim();
      const email = linha.cells[2].textContent.trim();
      const imgDaTabela = linha.querySelector(".mini-avatar-tabela");
      const srcAvatar = imgDaTabela ? imgDaTabela.getAttribute("src") : "/public/assets/default-avatar.png";

      document.getElementById("edit-id").value = id;
      document.getElementById("edit-email-original").value = email;
      document.getElementById("edit-input-username").value = username;
      document.getElementById("edit-input-nome").value = nome;
      document.getElementById("edit-input-email").value = email;
      //adicionei a imagem pro modal de editar
      document.getElementById("edit-avatar-clicavel").src = srcAvatar;
      modalEditar.style.display = "flex";
    }
  });
}

//if (formEditar) {
//  formEditar.addEventListener("submit", (e) => {
//    e.preventDefault();
//    modalEditar.style.display = "none";
//  });
//}

const fecharModalEditar = () => { if (modalEditar) modalEditar.style.display = "none"; };
if (btnFecharEditarX) btnFecharEditarX.addEventListener("click", fecharModalEditar);
if (btnCancelarEditar) btnCancelarEditar.addEventListener("click", fecharModalEditar);


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