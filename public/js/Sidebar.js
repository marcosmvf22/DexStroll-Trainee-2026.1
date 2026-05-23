const  buttonToggle = document.querySelector(".toggle-sidebar");
const sidebar = document.querySelector(".sidebar");

if(buttonToggle && sidebar)
{
    buttonToggle.addEventListener('click',(e)=> {
        e.stopPropagation();
        sidebar.classList.toggle('mobile-open');
    })

    document.addEventListener('click',(e)=>{
        if (!sidebar.contains(e.target) && sidebar.classList.contains('mobile-open')) {
            sidebar.classList.remove('mobile-open');
        }
    })
}
