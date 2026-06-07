const  buttonToggle = document.querySelector(".toggle-sidebar");
const habilitarSide = document.querySelector(".habilitar_sidebar");
const sidebar = document.querySelector(".sidebar");

if(buttonToggle)
{
    buttonToggle.addEventListener('click',(e)=> {
        e.stopPropagation();

        sidebar.classList.toggle('mobile-open');

        if (sidebar.classList.contains('mobile-open')) {
            habilitarSide.classList.add('sidebar-aberta');
        } else {
            habilitarSide.classList.remove('sidebar-aberta');
        }
    })

    document.addEventListener('click',(e)=>{
        if (!sidebar.contains(e.target) && sidebar.classList.contains('mobile-open')) {
            sidebar.classList.remove('mobile-open');
            habilitarSide.classList.remove('sidebar-aberta');
        }
    })
}
