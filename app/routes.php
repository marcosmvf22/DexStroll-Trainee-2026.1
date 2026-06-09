<?php

namespace App\Controllers;

use App\Controllers\InitController;
use App\Core\Router;
// aqui defini varias rotas e  respectivos controladores, nem tudo  foi feito  euacho
// lembra de rodar "composer dump-autoload" quando criar novos "controllers" 
//  pra atualizar as classes, senao nao funciona  bem

$router->get('', 'InitController@index');
// aqui  é a raiz, ta definido  pra entrar na landingpage, obviamente
// ele era  o "examplecontroller", renomeei para initcontroller

$router->get('postspage', 'PostController@index');

$router->get('login', 'logincontroller@index');

$router->get('cadastro', 'cadastrocontroller@index');

$router->get('postagem', 'postunicocontroller@index');

$router->get('dashboard', 'dashboardcontroller@index');

$router->get('usuarios', 'listadeusuarioscontroller@index');

$router->post('usuarios/criar', 'listadeusuarioscontroller@create');

$router->post('usuarios/atualizar', 'listadeusuarioscontroller@update');

$router->post('usuarios/deletar', 'listadeusuarioscontroller@delete');

$router->get('listadeposts' , 'PublicacoesController@index');

//outra  OBS, pra  visualizar a pagina sem liveserver, só digitar /"url" pra ver a pagina especifica no  localhost
