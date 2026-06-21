document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("slider-container");
    const setaEsquerda = document.getElementById("seta-esquerda");
    const setaDireita = document.getElementById("seta-direita");

    if (!container || !setaEsquerda || !setaDireita) return;

    const getScrollAmount = () => {
        const item = container.querySelector(".slider-item-landing");
        if (!item) return 0;
        
        const itemWidth = item.getBoundingClientRect().width;
        const gap = parseFloat(getComputedStyle(container).gap) || 0;
        
        return itemWidth + gap;
    };

    setaDireita.addEventListener("click", () => {
        container.scrollBy({
            left: getScrollAmount(),
            behavior: "smooth"
        });
    });

    setaEsquerda.addEventListener("click", () => {
        container.scrollBy({
            left: -getScrollAmount(),
            behavior: "smooth"
        });
    });
});