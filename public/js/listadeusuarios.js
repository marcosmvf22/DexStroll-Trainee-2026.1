//Infelizmente o JS está tirando minha sanidade, mas acho que consigo
//parece que a sintaxe é maneira até certo ponto
const listaUsuarios = [
  {
    username: "FlavinDoPneu",
    nome: "Nome Completo Um",
    email: "usuario1@email.com",
  },
  {
    username: "Shaolin_Matadordeporco",
    nome: "Nome Completo Dois",
    email: "usuario2@email.com",
  },
  {
    username: "a_aurea_vai_esculachar_minha_pagina",
    nome: "Nome Completo Três",
    email: "usuario3@email.com",
  },
];

//aparentemente declarar variável dinamica é bem melhor que no java, no java eu tinha que declarar strings etc de forma estática

const corpoTabela = document.querySelector(".tabela-usuarios tbody"); //eu acho que isso aqui filtra o elemento direto  da  classe da tabela.

// tive que ler uns 17 sites de tutorial, e no fim o bom e velho reddit ajudou,
// pelo que entendi: guardo as variaveis, injeto no HTML de forma não fixa, assim já fica meio caminho pro back end, eu acho.

if (corpoTabela) {
  corpoTabela.innerHTML = ""; //assim consigo redefinir qualquer lixo que estiver no HTML, parece mais fácil

  listaUsuarios.forEach((usuario) => {
    const linhaHTML = /* html */ `
      <tr>
        <td>${usuario.username}</td>
        <td>${usuario.nome}</td>
        <td>${usuario.email}</td>
        <td class="celula-acoes">
 <button class="botao-visualizar" title="Visualizar">
 
         
          <span class="material-symbols-outlined">person_search</span>


          </button>




          <button class="botao-editar" title="Editar">
         <span class="material-symbols-outlined">edit
</span>

          </button>
          <button class="botao-deletar" title="Deletar">
            <span class="material-symbols-outlined">person_cancel</span>
          </button>
        </td>
      </tr>
    `;

    corpoTabela.innerHTML += linhaHTML; //aparentemente a propriedade  cumulativa funciona igual no C++
  });
}
