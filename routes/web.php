<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

//consultas de las parsonas
$router->get('/personas', ['as' => 'Personas.index', 'uses' => 'PersonasController@index']);
$router->get('/personas/{id}', ['as' => 'Personas.find', 'uses' => 'PersonasController@find']);

//insercion y actualizacion de las personas
$router->post('/personas', ['as' => 'Personas.insercion', 'uses' => 'PersonasController@insercion']);
$router->put('/personas/{id}', ['as' => 'Personas.update', 'uses' => 'PersonasController@update']);

//Eliminacion de la persona
$router->delete('/personas/{id}', ['as' => 'Personas.delete', 'uses' => 'PersonasController@delete']);
