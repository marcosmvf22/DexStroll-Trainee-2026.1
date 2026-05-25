<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'ExampleController@index');

$router->get('postspage', 'PostController@index');

$router->get('login', 'logincontroller@index');

$router->get('cadastro', 'cadastrocontroller@index');

$router->get('postagem', 'postunicocontroller@index');