<?php

namespace App\Controllers;
use App\Controllers\PublicacoesController;
use App\Core\Router;


$router->get('', 'PublicacoesController@index');
$router->get('publicacoes', 'PublicacoesController@index');
$router->post('publicacoes/edit', 'PublicacoesController@edit');
$router->post('publicacoes/store', 'PublicacoesController@store');
$router->post('publicacoes/delete', 'PublicacoesController@delete');
$router->post('publicacoes/upload-imagem', 'PublicacoesController@uploadImagem');