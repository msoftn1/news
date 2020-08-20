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

//web site

$router->get('/', [
    'as' => 'index', 'uses' => 'NewsController@index'
]);

$router->get('/image/{name}', [
    'as' => 'image', 'uses' => 'NewsController@image'
]);

$router->get('/sources', [
    'as' => 'sources', 'uses' => 'NewsController@sources'
]);

$router->get('/source/{id}', [
    'as' => 'source.id', 'uses' => 'NewsController@sourceById'
]);

$router->get('/authors', [
    'as' => 'authors', 'uses' => 'NewsController@authors'
]);

$router->get('/author/{id}', [
    'as' => 'author.id', 'uses' => 'NewsController@authorById'
]);

$router->get('/view/{id}', [
    'as' => 'view', 'uses' => 'NewsController@view'
]);

$router->get('/search/date/{dateStart}/{dateEnd}', [
    'as' => 'date', 'uses' => 'NewsController@date'
]);

$router->get('/language/{language}', [
    'as' => 'language', 'uses' => 'NewsController@language'
]);

$router->get('/category/{category}', [
    'as' => 'category', 'uses' => 'NewsController@category'
]);

$router->get('/search/ajax', [
    'as' => 'search.ajax', 'uses' => 'NewsController@searchAjax'
]);

$router->get('/search', [
    'as' => 'search', 'uses' => 'NewsController@search'
]);


//api
$router->get('/api/sources', ['uses' => 'ApiController@sources', 'middleware' => 'auth:api']);
$router->get('/api/newsBySource', ['uses' => 'ApiController@newsBySource', 'middleware' => 'auth:api']);
$router->get('/api/newsByLanguage', ['uses' => 'ApiController@newsByLanguage', 'middleware' => 'auth:api']);
$router->get('/api/newsByCategory', ['uses' => 'ApiController@newsByCategory', 'middleware' => 'auth:api']);
$router->get('/api/newsByCountry', ['uses' => 'ApiController@newsByCountry', 'middleware' => 'auth:api']);
$router->get('/api/newsSearch', ['uses' => 'ApiController@newsSearch', 'middleware' => 'auth:api']);
