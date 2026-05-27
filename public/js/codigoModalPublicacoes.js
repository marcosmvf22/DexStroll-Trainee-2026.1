const filtro = document.querySelector('#filtroFundoModal');
const checkbox = document.getElementById('toggle-curiosidade');
const inputContainer = document.getElementById('input-container');


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

checkbox.addEventListener('change', function() {
  if (this.checked) {
    inputContainer.classList.remove('hidden'); // Mostra o input
  } else {
    inputContainer.classList.add('hidden');    // Esconde o input
  }
});