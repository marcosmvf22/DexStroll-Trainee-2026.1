<?php
namespace App\Controllers;

use App\Controllers\InitController;
use App\Controllers\LoginController;
use App\Core\Router;
// aqui defini varias rotas e  respectivos controladores, nem tudo  foi feito  euacho
// lembra de rodar "composer dump-autoload" quando criar novos "controllers" 
//  pra atualizar as classes, senao nao funciona  bem


//Rota da landing page
$router->get('', 'InitController@index');


//Rota da pagina de ultimas postagens
$router->get('postspage', 'PostController@index');


//Rota da pagina de visualização individual
$router->get('postagem', 'postunicocontroller@index');

//Rota da pokedex
$router->get('pokedex', 'pokedexController@index');


//Rotas do login
$router->get('login', 'LoginController@login');

$router->post('login', 'LoginController@efetuaLogin');

$router->post('logout', 'LoginController@logout');

$router->post('login/create', 'LoginController@store');

//Rota da dashboard
$router->get('dashboard', 'dashboardcontroller@index');


//Rotas da lista de usuarios
$router->get('usuarios', 'listadeusuarioscontroller@index');

$router->post('usuarios/criar', 'listadeusuarioscontroller@create');

$router->post('usuarios/atualizar', 'listadeusuarioscontroller@update');

$router->post('usuarios/deletar', 'listadeusuarioscontroller@delete');

$router->get('listadeposts' , 'PublicacoesController@index');


//Rotas da lista de posts
$router->get('publicacoes', 'PublicacoesController@index');

$router->post('publicacoes/edit', 'PublicacoesController@edit');

$router->post('publicacoes/store', 'PublicacoesController@store');

$router->post('publicacoes/delete', 'PublicacoesController@delete');

$router->post('publicacoes/upload-imagem', 'PublicacoesController@uploadImagem');


//Funções de popular bancos 

$router->get('usuarios/popular', 'listadeusuarioscontroller@popularBanco');

$router->get('publicacoes/popular', 'PublicacoesController@popularPosts');