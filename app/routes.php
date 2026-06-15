<?php
namespace App\Controllers;

use App\Controllers\InitController;
use App\Controllers\LoginController;
use App\Core\Router;
// aqui defini varias rotas e  respectivos controladores, nem tudo  foi feito  euacho
// lembra de rodar "composer dump-autoload" quando criar novos "controllers" 
//  pra atualizar as classes, senao nao funciona  bem

$router->get('', 'InitController@index');

$router->get('postspage', 'PostController@index');

$router->get('postagem', 'postunicocontroller@index');

$router->get('usuarios', 'listadeusuarioscontroller@index');

$router->post('usuarios/criar', 'listadeusuarioscontroller@create');

$router->post('usuarios/atualizar', 'listadeusuarioscontroller@update');

$router->post('usuarios/deletar', 'listadeusuarioscontroller@delete');

$router->get('listadeposts' , 'PublicacoesController@index');

$router->get('publicacoes', 'PublicacoesController@index');

$router->post('publicacoes/edit', 'PublicacoesController@edit');

$router->post('publicacoes/store', 'PublicacoesController@store');

$router->post('publicacoes/delete', 'PublicacoesController@delete');

$router->post('publicacoes/upload-imagem', 'PublicacoesController@uploadImagem');

//outra  OBS, pra  visualizar a pagina sem liveserver, só digitar /"url" pra ver a pagina especifica no  localhost

$router->get('login', 'LoginController@login');

$router->get('dashboard', 'LoginController@dashboard');

$router->post('login', 'LoginController@efetuaLogin');

$router->post('logout', 'LoginController@logout');

$router->post('login/create', 'LoginController@store');

// abaixo executa função para  encher o banco de  usuario de nome aleatorio pra  teste

$router->get('usuarios/popular', 'listadeusuarioscontroller@popularBanco');

$router->get('pokedex', 'pokedexController@index');


//encher  o banco de  posts
$router->get('publicacoes/popular', 'PublicacoesController@popularPosts');