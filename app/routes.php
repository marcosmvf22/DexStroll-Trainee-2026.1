<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('publicacoes', 'PublicacoesController@index');
$router->post('publicacoes/edit', 'PublicacoesController@edit');