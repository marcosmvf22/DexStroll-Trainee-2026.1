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


        // is same or not.
        function checkPassword(form) {
            senha = form.senha.value;
            confirmaSenha = form.confirmaSenha.value;

            // If password not entered
            if (senha == '')
                alert("Por favor, digite a senha!!");

            // If confirm password not entered
            else if (confirmaSenha == '')
                alert("Por favor, confirme a senha");

            // If Not same return False.    
            else if (senha != confirmaSenha) {
                alert("\nAs senhas não se coincidem: Por favor tente novamente...")
                return false;
            }

            // If same return True.
            else {
                alert("Cadastro realizado com sucesso!")
                return true;
            }
        }