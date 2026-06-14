const pokemonName = document.querySelector('.pokemon_name');
const pokemonNumber = document.querySelector('.pokemon_number');
const pokemonImage = document.querySelector('.pokemon_image');
const pokemonHeight = document.querySelector('.pokemon_height');
const pokemonWeight = document.querySelector('.pokemon_weight');
const pokemonEvolution = document.querySelector('.pokemon_evolution');
const pokemonEncounters = document.querySelector('.pokemon_encounters');
const pokemonMethods = document.querySelector('.pokemon_methods');
const pokemonConditions = document.querySelector('.pokemon_conditions');

const form = document.querySelector('.barra_busca');
const input = document.querySelector('.input_search');

const buttonPrev = document.querySelector('.btn-prev');
const buttonNext = document.querySelector('.btn-next');

let searchPokemon = 1;

// Busca dados base do Pokémon
const fetchPokemon = async (pokemon) => {
    const APIResponse = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemon}`);
    if(APIResponse.status == 200){
        const data = await APIResponse.json(); 
        return data;
    }
    return null;
}

// Busca os locais de encontro do Pokémon
const fetchPokemonEncounters = async (id) => {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${id}/encounters`);
    if(response.status == 200){
        const dataEncounter = await response.json();
        return dataEncounter;
    }
    return null;
} 

// Busca a linha evolutiva do Pokémon
const fetchPokemonEvolution = async(id) => {
    const speciesResponse = await fetch(`https://pokeapi.co/api/v2/pokemon-species/${id}`); 
    if(speciesResponse.status == 200){
        const speciesData = await speciesResponse.json();
        const evolutionUrl = speciesData.evolution_chain.url; 
        const evolutionResponse = await fetch(evolutionUrl); 
        const evolutionData = await evolutionResponse.json();
        return evolutionData; 
    }
    return null;
}

const renderPokemon = async (pokemon) => { 
    pokemonName.innerHTML = 'Carregando...';

    const data = await fetchPokemon(pokemon);

    if(data){
        // Dados básicos
        pokemonImage.style.display = 'block';
        pokemonName.innerHTML = data.name;
        pokemonNumber.innerHTML = data.id;
        pokemonHeight.innerHTML = `Altura: ${data.height/10} m`;
        pokemonWeight.innerHTML = `Peso: ${data.weight/10} kg`;

        // //  ENCONTROS, MÉTODOS E CONDIÇÕES 
        // const encountersData = await fetchPokemonEncounters(data.id);
        // if (encountersData && encountersData.length > 0) {
        //     // Locais
        //     const locais = encountersData.map(lugar => lugar.location_area.name);
        //     pokemonEncounters.innerHTML = locais.slice(0, 3).join(', '); // Pega os 3 primeiros pra não estourar o layout

        //     // Métodos
        //     const metodos = encountersData.map(lugar => {
        //         return lugar.version_details.map(detail => detail.encounter_details.map(enc => enc.method.name));
        //     }).flat(2);
        //     pokemonMethods.innerHTML = [...new Set(metodos)].join(', ');

        //     // Condições
        //     const condicoes = encountersData.map(lugar => {
        //         return lugar.version_details.map(detail => detail.encounter_details.map(enc => enc.condition_values.map(c => c.name)));
        //     }).flat(3);
        //     pokemonConditions.innerHTML = condicoes.length > 0 ? [...new Set(condicoes)].join(', ') : 'Nenhuma';
        // } else {
        //     pokemonEncounters.innerHTML = 'Não encontrado na natureza';
        //     pokemonMethods.innerHTML = '-';
        //     pokemonConditions.innerHTML = '-';
        // }

        //EVOLUÇÕES
        const evolutionData = await fetchPokemonEvolution(data.id);
        if(evolutionData){
            let proximaEvolucao = null;
            let atual = evolutionData.chain;

            while(atual){
                if (atual.species.name === data.name.toLowerCase()){
                    if(atual.evolves_to.length > 0){
                        proximaEvolucao = atual.evolves_to[0].species.name;
                    }
                    break;
                }
                atual = atual.evolves_to[0];
            }

            if(proximaEvolucao){
                pokemonEvolution.innerHTML = `Evolução: ${capitalizarPrimeiraLetra(proximaEvolucao)}`;
            } else {
                pokemonEvolution.innerHTML = 'Não evolui';
            }
        } else {
            pokemonEvolution.innerHTML = 'Sem dados de evolução';
        }

        //TRATAMENTO DA IMAGEM
        try {
            const gifAnimado = data['sprites']['versions']['generation-v']['black-white']['animated']['front_default'];
            pokemonImage.src = gifAnimado || data['sprites']['front_default'];
        } catch (error) {
            pokemonImage.src = data['sprites']['front_default'];
        }

        input.value = '';
        searchPokemon = data.id;
    }
    else {
        pokemonImage.style.display = 'none';
        pokemonName.innerHTML = 'Não encontrado!';
        pokemonNumber.innerHTML = '';
        pokemonEncounters.innerHTML = '';
        pokemonMethods.innerHTML = '';
        pokemonConditions.innerHTML = '';
        pokemonEvolution.innerHTML = '';
    }
}

// Eventos dos botões
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

function capitalizarPrimeiraLetra(str) {
  if (!str) return "";
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// Inicializa o app
renderPokemon(searchPokemon);

function menuShowNav() {
    let mobileMenuNav = document.querySelector('.mobile-menu-nav-pokedex');
    let headerNav = document.querySelector('.header-nav-pokedex');
    let lineNav = document.querySelector('.line-nav-pokedex');
    let blocoMenuNav = document.querySelector('.bloco-icone-menu-nav-pokedex');

    if (mobileMenuNav.classList.contains('open')) {
        mobileMenuNav.classList.remove('open');
        document.querySelector('#icone-menu-nav-pokedex').className = "fa-solid fa-bars";
        headerNav.style.background = "transparent";
        lineNav.style.borderColor = "#5a1a22";
        blocoMenuNav.style.boxShadow = "5px 5px 10px #0d2a4d";

    } else {
        mobileMenuNav.classList.add('open');      
        document.querySelector('#icone-menu-nav-pokedex').className = "fa-solid fa-x";
        headerNav.style.background = "#5a1a22";
        lineNav.style.borderColor = "#e1352c";
        blocoMenuNav.style.boxShadow = "none";
    }
}