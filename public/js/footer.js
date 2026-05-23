const filtro = document.getElementById('filtro');
const fechar = document.querySelector(".fechar-modal");

function abrirModal(idModal)
{
    const modal = document.getElementById(idModal);
    modal.style.display = 'flex';
    filtro.style.display = 'flex';
    fechar.style.display = 'block';
}

function fecharModal(idModal)
{
    const modal = document.getElementById(idModal);
    modal.style.display = 'none';
    filtro.style.display = 'none';
    fechar.style.display = 'none';
}