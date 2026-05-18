//Infelizmente o JS está tirando minha sanidade, mas acho que consigo
//parece que a sintaxe é maneira até certo ponto
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

//aparentemente declarar variável dinamica é bem melhor que no java, no java eu tinha que declarar strings etc de forma estática

const corpoTabela = document.getElementById("corpo-tabela-usuarios"); 

if (corpoTabela) {
  corpoTabela.innerHTML = ""; // Tirar o HTML (mesmo nao sendo  util agora)

  listaUsuarios.forEach((usuario) => {
    //eu  vi que esse comentário abaixo pode ajudar minha extensão (prettier) a formatar minhas tags HTML dentro do JS
    //pelo que entendi a crase faz o html ser injetado deforma linear, resumindo, eu nao entendi, mas funciona
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

    corpoTabela.innerHTML += linhaHTML; //aparentemente a propriedade  cumulativa funciona igual no C++
  });
}
