function menuShowNav() {
    let mobileMenuNav = document.querySelector('.mobile-menu-nav');
    let headerNav = document.querySelector('.header-nav');
    let lineNav = document.querySelector('.line-nav');
    let blocoMenuNav = document.querySelector('.bloco-icone-menu-nav');

    if (mobileMenuNav.classList.contains('open')) {
        mobileMenuNav.classList.remove('open');
        document.querySelector('#icone-menu-nav').className = "fa-solid fa-bars";
        headerNav.style.background = "transparent";
        lineNav.style.borderColor = "#5a1a22";
        blocoMenuNav.style.boxShadow = "5px 5px 10px #0d2a4d";

    } else {
        mobileMenuNav.classList.add('open');      
        document.querySelector('#icone-menu-nav').className = "fa-solid fa-x";
        headerNav.style.background = "#5a1a22";
        lineNav.style.borderColor = "#e1352c";
        blocoMenuNav.style.boxShadow = "none";
    }
}