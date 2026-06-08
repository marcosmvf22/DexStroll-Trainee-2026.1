<?php

namespace App\Controllers;
use App\Controllers\LoginController;
use App\Core\Router;


$router->get('login', 'LoginController@login');
$router->get('dashboard', 'LoginController@dashboard');
$router->post('login', 'LoginController@efetuaLogin');
$router->post('logout', 'LoginController@logout');