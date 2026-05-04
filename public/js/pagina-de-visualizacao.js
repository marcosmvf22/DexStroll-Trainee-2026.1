const slider = document.querySelector('.carrossel-conteudo');
const slider_content = document.querySelector('.carrossel-conteudo ul');
const radio_auto = document.querySelector('.radio-auto');
const left_arrow = document.getElementById('seta-esquerda');
const right_arrow = document.getElementById('seta-direita');
const carrossel = document.querySelector('.carrossel');

let current_page = 0;
let itens_per_view = 1;
let total_pages = 1;
let auto_slide_interval;

function updateCarrossel ()
{
    const slider_width = slider.offsetWidth;
    const item_width = slider_content.children[0].getBoundingClientRect().width;

    itens_per_view = Math.floor(slider_width/item_width);
    total_pages = Math.ceil((slider_content.children.length / itens_per_view));
    
    createRadioLabel();
    updateRadioLabel();
}

function createRadioLabel()
{
    radio_auto.innerHTML = "";
    for(let i = 0; i< total_pages; i++)
    {
        const label = document.createElement('div');
        label.classList.add('radio-label');

        if(i === 0)
        {
            label.classList.add('active');
        }

        label.addEventListener('click', () =>{
            current_page = i;
            scrollToPage();
        });

        radio_auto.appendChild(label);
    }
}

function updateRadioLabel()
{
    const label = document.querySelectorAll('.radio-label');
    label.forEach((l,i) => {
        l.classList.toggle('active', i===current_page);
    });
}

function scrollToPage()
{
    const item_width = slider_content.children[0].getBoundingClientRect().width;
    const gap = 20;
    const newPosition = (item_width + gap) * itens_per_view * current_page;

    slider.scrollTo({left: newPosition, behavior:'smooth'});
    updateRadioLabel();
    
}

function moveLeft()
{
    current_page--;
    if(current_page < 0)
    {
        current_page = total_pages -1;
    }
    scrollToPage();
    resetAutoSlide();
}

function moveRight()
{
    current_page++;
    if(current_page >=total_pages)
    {
        current_page = 0;
    }
    scrollToPage();
    resetAutoSlide();
}


function startAutoSlide()
{
    clearInterval(auto_slide_interval);
    auto_slide_interval = setInterval( () => {
        moveRight();
    }, 4000);
}

function resetAutoSlide()
{
    clearInterval(auto_slide_interval);
    startAutoSlide();
}

left_arrow.addEventListener('click', moveLeft);
right_arrow.addEventListener('click', moveRight);
window.addEventListener('resize',updateCarrossel);

carrossel.addEventListener('mouseenter', () => {
    clearInterval(auto_slide_interval);
});

carrossel.addEventListener('mouseleave', () => {
    startAutoSlide();
});

updateCarrossel();
startAutoSlide();