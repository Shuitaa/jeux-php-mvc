<?php

use Config\Autoloader;

require '../config/Autoloader.php';
require '../config/Helpers.php';

Autoloader::register();

$router = new Routes\Router($_GET['url']);

$router->get('/', 'TitanController@index');
$router->get('/titan', 'TitanController@create');
$router->get('/titan/modify/:id', 'TitanController@edit');
$router->get('/titan/:id', 'TitanController@show');
$router->get('/titan/delete/:id', 'TitanController@destroy');
$router->post('/attack', 'TitanController@fight');
$router->post('/titan', 'TitanController@store');
$router->post('/titan/:id', 'TitanController@update');

$router->try();
