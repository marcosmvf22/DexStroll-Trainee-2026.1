const filtro = document.querySelector('#filtroFundoModal');
const toggleCuriosidade = document.querySelector('#toggle-curiosidade');
const grupoCuriosidade = document.querySelector('#input-container-curiosidade')

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

toggleCuriosidade.addEventListener('change', function(){
    if(toggleCuriosidade.checked){
        grupoCuriosidade.style.display = "flex";
    } else{
        grupoCuriosidade.style.display = "none";
    }
});