var containerLogin = document.querySelector(".container-principal-login");
var linkLogin = document.querySelector("#icone-voltar-cadastro");
var linkCadastro = document.querySelector(".texto-link-login");

var body = document.querySelector("body");

linkLogin.onclick = () => {
    containerLogin.classList.remove("cadastroActive");
    containerLogin.classList.add("loginActive");
};

linkCadastro.onclick = () => {
    containerLogin.classList.remove("loginActive");
    containerLogin.classList.add("cadastroActive");
};