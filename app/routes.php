<?php

namespace App\Controllers;
use App\Controllers\PublicacoesController; //atualizei pra deixar igual a do Pedro
use App\Core\Router;


//$router->get('', 'InitController@index');
$router->get('', 'PublicacoesController@index');
$router->get('publicacoes', 'PublicacoesController@index');
$router->post('publicacoes/edit', 'PublicacoesController@edit');
$router->post('publicacoes/store', 'PublicacoesController@store');
$router->post('publicacoes/delete', 'PublicacoesController@delete');