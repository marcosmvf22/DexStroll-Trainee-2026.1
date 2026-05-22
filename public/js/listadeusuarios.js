const listaUsuarios = [
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

const corpoTabela = document.getElementById("corpo-tabela-usuarios"); 

if (corpoTabela) {
  corpoTabela.innerHTML = ""; 

  listaUsuarios.forEach((usuario) => {
    const linhaHTML = /* html */ `  
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
          <button class="botao-acao botao-deletar" title="Deletar">
            <span class="material-icons">delete</span>
          </button>
        </td>
      </tr>
    `;

    corpoTabela.innerHTML += linhaHTML; 
  });
}