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

$router->group(['prefix' => 'api'], function () use ($router){
   $router->get('/posts','PostController@index');
   $router->post('/create/post','PostController@createPost');
   $router->post('/update/post','PostController@updatePost');
   $router->post('/delete/post','PostController@delete');
   $router->post('/like/post','PostController@like');
});