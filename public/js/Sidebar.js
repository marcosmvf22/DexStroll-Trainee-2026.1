const  buttonToggle = document.querySelector(".material-icons");

buttonToggle.addEventListener('click', () =>{
    document.querySelector('.sidebar').classList.toggle('open-sidebar');
})