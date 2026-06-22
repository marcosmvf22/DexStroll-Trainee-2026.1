const logoCode = document.getElementById('easter-egg');
const somPikachu = new Audio('public/assets/som_pikachu.mp3')


let contadorClick = 0;
let tempoUltimoClique = 0;

logoCode.addEventListener('click', () => {
    const agora = Date.now();
        if (agora - tempoUltimoClique > 1500) {
            contadorClick = 0;
        }
        
        contadorClick++;
        tempoUltimoClique = agora;

        if (contadorClick === 5) {
            ativarEasterEgg();
            contadorClick = 0; 
        }
});

function ativarEasterEgg() {
    somPikachu.currentTime = 0;
    somPikachu.play();
}