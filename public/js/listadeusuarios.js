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
//pega do html e enfia em uma constante do JS, pra poder ser trabalhada  sem mapear toda vez, eu  acho que funciona assim
const corpoTabela = document.getElementById("corpo-tabela-usuarios");
//fiz a função de  renderizar porque achei mais facil,  se é o certo, nao  sei.
//desgraça de teclado ta dando espaço duplo
function renderizarTabela() { 
  // coloquei  essa IF abaixo, porque se mudar a tag do html o firefox inceideia meu prédio inteiro quando abre.
  if (corpoTabela) { 
    corpoTabela.innerHTML = ""; //reseta o  HTML para renderizar o codigo aqui no JS
// o for each para dar loop em cada celula e aplicar o código, acho que é igual o for  do c++ porém meio aviadado pra arrays.
    listaUsuarios.forEach((usuario) => {
      const linhaHTML =  `  
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
      corpoTabela.innerHTML += linhaHTML; //soma tudo, criando mais linha, senao nao seria  uma tabela.
    });
  }
}
// na questão do document, arvore dom etc, fiquei confuso, mas pelo que entendi pega hierarquia igual camadas  mesmo, ta funcionando eu acho
renderizarTabela();
// **tive que botar isso, mapear  o documento inteiro para poder renderizar sem ter que clicar na pagina, talvez pese o site no futuro**
const modal = document.getElementById("modal-usuario");
const btnAbrir = document.getElementById("btn-abrir-modal");
const btnFecharX = document.getElementById("btn-fechar-x");
const btnCancelar = document.getElementById("btn-cancelar");
const formulario = document.getElementById("form-novo-usuario");
const avatarClicavel = document.getElementById("avatar-clicavel");
const inputAvatarReal = document.getElementById("input-avatar");

// nao achei outro jeito alem do bom e velho "if"...
// nao  tire esse  IF, porque o listener invade meus sonhos de madrugada 
// se nao achar  o elemento, dá um erro  enorme de null property blá blá  blá.
if (btnAbrir && modal) {
  btnAbrir.addEventListener("click", () => {
    // se abrir o modal ele muda  de none para flex, porque grid é uma  bosta
    modal.style.display = "flex";
  });
}
// se fechar o modal, ele fecha, quem diria
const fecharOModal = () => {  //ao fazer isso, nao preciso escrever o codigo pra cada botaozinho toda vez.
  if (modal) modal.style.display = "none"; 
};

if (btnFecharX) btnFecharX.addEventListener("click", fecharOModal); //faz o X fechar o modal, é a unica função dele, então é bom que ele cumpra
if (btnCancelar) btnCancelar.addEventListener("click", fecharOModal); //redundante, talvez, mas tem bagre que nao  vai clicar no x, então tem um "cancelar"
//mesma coisa que  acima, o listener é util mas foi feito pelo  demiurgo
if (avatarClicavel && inputAvatarReal) {
  avatarClicavel.addEventListener("click", () => {
    inputAvatarReal.click(); //porque clicar na setinha se  pode clicar na foto tbm...
  });
}

if (formulario) {
  // a  seta  => enfia a função sem ter que aviadar  mais meu código.
  //  esse  submit funcionou melhor que o "click", agora funciona dando enter no teclado.
  formulario.addEventListener("submit", (evento) => {
    //esse evento ta como parametro, eu tava com 18 abas abertas no navegador, e pelo que vi funciona melhor pra nao quebrar no f5
    //essa bosta atualiza quando da enter, quando testei no celular nao deu, mas   enfim a  insanidade
    evento.preventDefault(); //impede o  fdp do firefox de quebrar a caixinha de digitar


    const novoUsuario = {
      //pelo que entendi no blog da mozilla  e no stack, o .value especifica o que foi digitado, para nao pegar
      //o resto do elemento tipo borda, texto exemplo etc,  apenas o que usuario  digita.
      username: document.getElementById("input-username").value, //esse value busca direto no ID do input e pega o que foi digitado, assim  nao quebra,  eu espero
      nome: document.getElementById("input-nome").value,
      email: document.getElementById("input-email").value,
    };

    listaUsuarios.unshift(novoUsuario); //pega isso tudo e mete na  linha de cima, começo da tabela.
    renderizarTabela(); //pega o quefoi digitado, le no array, e enfia na tabela, porque senao nao adianta
    formulario.reset(); //Finalmente consegui fazer ele escafletar o formulario para  digitar o proximo usuario
    fecharOModal(); //que legal, o modal é um modal, logo ele fecha, igualzinho um modal
  });
}
//o caba endoidou