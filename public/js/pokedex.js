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
        pokemonHeight.innerHTML = `<strong>Altura:</strong> ${data.height/10} m`;
        pokemonWeight.innerHTML = `<strong>Peso:</strong> ${data.weight/10} kg`;

    
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
                pokemonEvolution.innerHTML = `<strong>Evolução:</strong> ${capitalizarPrimeiraLetra(proximaEvolucao)}`;
            } else {
                pokemonEvolution.innerHTML = '<strong>Evolução:</strong>Não evolui';
            }
        } else {
            pokemonEvolution.innerHTML = '<strong>Evolução:</strong>Sem dados de evolução';
        }

    // //  ENCONTROS, MÉTODOS E CONDIÇÕES 
       const encountersData = await fetchPokemonEncounters(data.id);

    if (encountersData && encountersData.length > 0) {
        // Locais
        const locais = encountersData.map(lugar => lugar.location_area.name);
        const listaLocais = locais.slice(0, 3).join(', ');
        pokemonEncounters.innerHTML = `<br><strong>Local:</strong> ${listaLocais}`;

        // Métodos
        const metodos = encountersData.map(lugar => {
            return lugar.version_details.map(detail => detail.encounter_details.map(enc => enc.method.name));
        }).flat(2);
        const listaMetodos = [...new Set(metodos)].join(', ');
        pokemonMethods.innerHTML = `<br><strong>Método:</strong> ${listaMetodos}`;

        // Condições
        const condicoes = encountersData.map(lugar => {
            return lugar.version_details.map(detail => detail.encounter_details.map(enc => enc.condition_values.map(c => c.name)));
        }).flat(3);
        const listaCondicoes = condicoes.length > 0 ? [...new Set(condicoes)].join(', ') : 'Nenhuma';
        pokemonConditions.innerHTML = `<br><strong>Condição:</strong> ${listaCondicoes}`;

    } else {
        // Caso o pokémon não tenha dados de encontro
        pokemonEncounters.innerHTML = '<br><strong>Local:</strong> Não encontrado na natureza';
        pokemonMethods.innerHTML = '<br><strong>Método:</strong> -';
        pokemonConditions.innerHTML = '<br><strong>Condição:</strong> -';
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

