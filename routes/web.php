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

$router->get('contacts', ['as' => 'contacts', 'uses' => 'ContactController@index']);
$router->get('contacts/{id}', ['as' => 'contacts.show', 'uses' => 'ContactController@show']);
$router->post('contacts', ['as' => 'contacts.store', 'uses' => 'ContactController@store']);
$router->put('contacts/{id}', ['as' => 'contacts.update', 'uses' => 'ContactController@update']);
$router->delete('contacts/{id}', ['as' => 'contacts.destroy', 'uses' => 'ContactController@destroy']);
