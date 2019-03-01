<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return 'Bienvenido al Test desarrollador Backend para Quick';

});

$router->group(['prefix' => 'api'], function($router){
	//$router->get('home' , 'UserController@home');
	//$router->get('user' , 'UserController@index');
});

//Login
$router->post('/login', 'UserController@login');

//Registro
$router->post('/register', 'UserController@register');

//Modificar
$router->put('/users/{id}', 'UserController@update');

//Obtener todos los usuarios
$router->get('/users', 'UserController@getallusers');

//Consultar usuario especifico
$router->get('/users/{id}', 'UserController@getuserfromid');

//Borrar usuario
$router->delete('/users/{id}', 'UserController@deletefromid');

//Cualquier otro intento fuera de los endpoint
$router->get('/{id}', 'UserController@deletefromid');




$router->group(['middleware' => 'auth'], function($router){
	$router->get('logg',[ 'login' => 'UserController@login']);
});