<?php

namespace App\Controllers;

use App\Controllers\InitController;
use App\Core\Router;

$router->get('', 'InitController@index');

$router->get('postspage', 'PostController@index');

$router->get('login', 'logincontroller@index');

$router->get('cadastro', 'cadastrocontroller@index');

$router->get('postagem', 'postunicocontroller@index');

$router->get('dashboard', 'dashboardcontroller@index');

$router->get('usuarios', 'listadeusuarioscontroller@index');