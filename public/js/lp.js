document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("slider-container");
    const setaEsquerda = document.getElementById("seta-esquerda");
    const setaDireita = document.getElementById("seta-direita");

    if (!container || !setaEsquerda || !setaDireita) return;

    
    const tempoSegundos = 3; 
    let autoplayInterval;

    const getScrollAmount = () => {
        const item = container.querySelector(".slider-item-landing");
        if (!item) return 0;
        
        const itemWidth = item.getBoundingClientRect().width;
        const gap = parseFloat(getComputedStyle(container).gap) || 0;
        
        return itemWidth + gap;
    };


    const moverDireita = () => {
        const scrollAmount = getScrollAmount();
        
    
        const noFinal = container.scrollLeft >= (container.scrollWidth - container.clientWidth - 5);

        if (noFinal) {
            container.scrollTo({
                left: 0,
                behavior: "smooth"
            });
        } else {
            container.scrollBy({
                left: scrollAmount,
                behavior: "smooth"
            });
        }
    };

    const moverEsquerda = () => {
        container.scrollBy({
            left: -getScrollAmount(),
            behavior: "smooth"
        });
    };

   
    const iniciarAutoplay = () => {
        autoplayInterval = setInterval(moverDireita, tempoSegundos * 1000);
    };

    const pararAutoplay = () => {
        clearInterval(autoplayInterval);
    };


    setaDireita.addEventListener("click", () => {
        pararAutoplay();
        moverDireita();
        iniciarAutoplay();
    });

    setaEsquerda.addEventListener("click", () => {
        pararAutoplay();
        moverEsquerda();
        iniciarAutoplay();
    });

    
    container.addEventListener("mouseenter", pararAutoplay);
    container.addEventListener("mouseleave", iniciarAutoplay);

    
    iniciarAutoplay();
});