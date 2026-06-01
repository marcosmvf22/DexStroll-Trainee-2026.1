<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('publicacoes', 'PublicacoesController@index');
$router->post('publicacoes/edit', 'PublicacoesController@edit');
$router->post('publicacoes/criar', 'PublicacoesController@store');
// $router->delete('publicacoes/delete', 'PublicacoesController@delete');