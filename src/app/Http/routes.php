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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/', ['uses' => 'FrogController@index', 'as' => 'index']);

$app->get('frog', ['uses' => 'FrogController@index', 'as' => 'frog.index']);

$app->get('frog/create', ['uses' => 'FrogController@create', 'as' => 'frog.create']);

$app->post('frog/create', ['uses' => 'FrogController@store', 'as' => 'frog.store']);

$app->get('frog/{id}', ['uses' => 'FrogController@edit', 'as' => 'frog.edit']);

$app->post('frog/{id}', ['uses' => 'FrogController@update', 'as' => 'frog.update']);


