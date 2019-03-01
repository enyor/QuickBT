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
    return 'Hello World';

});

$router->group(['prefix' => 'api'], function($router){
	$router->get('home' , 'UserController@home');
	$router->get('user' , 'UserController@index');
});

$router->post('/login', 'UserController@login');
$router->post('/register', 'UserController@register');


$router->group(['middleware' => 'auth'], function($router){
	$router->get('api/v1',[ 'home' => 'UserController@home']);
});