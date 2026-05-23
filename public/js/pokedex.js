// Recolhe os dados da API
// 'async' é adicionado antes dos parenteses pois é assincrono
// 'await' é para esperar até os dados serem recebidos através da conexão com o servidor

const pokemonName = document.querySelector('.pokemon_name');
const pokemonNumber = document.querySelector('.pokemon_number');
const pokemonImage = document.querySelector('.pokemon_image');

const form = document.querySelector('.form');
const input = document.querySelector('.input_search');

const buttonPrev = document.querySelector('.btn-prev');
const buttonNext = document.querySelector('.btn-next');

let searchPokemon = 1;

const fetchPokemon = async (pokemon) => {

    const APIResponse = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemon}`);
    

    if(APIResponse.status == 200){
        const data = await APIResponse.json(); 
        return data;
    }

    //data é pra BUSCAR os dados
    //.json é o metodo q permite a recepção das informações em json
    

}

const renderPokemon = async (pokemon) => {
    pokemonName.innerHTML = 'Loading...';

    const data = await fetchPokemon(pokemon); //guarda os dados do pokemon
    //a função fetch retorna uma PROMISE;
    
    if(data){
        pokemonImage.style.display = 'block';
        pokemonName.innerHTML = data.name;
        pokemonNumber.innerHTML = data.id;
        pokemonImage.src = data['sprites']['versions']['generation-v']['black-white']['animated']['front_default'];
        input.value = '';
        searchPokemon = data.id;
    }
    else{
        pokemonImage.style.display = 'none';
        pokemonName.innerHTML = 'Not found :(';
        pokemonNumber.innerHTML = '';
    }
    
}

form.addEventListener('submit', (event) => {

    event.preventDefault();
    renderPokemon(input.value.toLowerCase());
    input.value = '';
});


buttonPrev.addEventListener('click', () => {
    if(searchPokemon > 1){
        searchPokemon--;
        renderPokemon(searchPokemon);
    }
});

buttonNext.addEventListener('click', () => {
    searchPokemon++;
    renderPokemon(searchPokemon);
});

renderPokemon(searchPokemon);