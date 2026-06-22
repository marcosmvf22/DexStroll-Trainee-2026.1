const filtro = document.querySelector('#filtroFundoModal');
const toggleCuriosidade = document.querySelector('#toggle-curiosidade');
const grupoCuriosidade = document.querySelector('#input-curiosidades-modal')

function abrirModal(idModal){
    const modal = document.getElementById(idModal);
    modal.style.display = "flex";
    filtro.style.display = "flex";
}

function fecharModal(idModal){
    const modal = document.getElementById(idModal);
    modal.style.display = "none";
    filtro.style.display = "none";
}

document.getElementById('input-imagemModalCriar').addEventListener('change', function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();

        reader.onloadend = function(){
            const dados = reader.result;
            document.getElementById('imagemSelecionada').src = dados;
            document.getElementById('imagemSelecionada').style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
});

toggleCuriosidade.addEventListener('change', function() {
    if (this.checked) {
        grupoCuriosidade.style.display = "block";
    } else {
        grupoCuriosidade.style.display = "none";
    }
});