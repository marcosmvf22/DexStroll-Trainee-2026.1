<?php

namespace App\Controllers;
use App\Controllers\InitController; //atualizei pra deixar igual a do Pedro
use App\Core\Router;


$router->get('', 'InitController@index');
$router->get('publicacoes', 'PublicacoesController@index');
$router->post('publicacoes/edit', 'PublicacoesController@edit');
$router->post('publicacoes/criar', 'PublicacoesController@store');
$router->post('publicacoes/delete', 'PublicacoesController@delete');