<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('login_user', 'AuthController@authenticate');
Route::post('register_user', 'AuthController@register_user');
Route::post('logout_user', 'AuthController@logout');
Route::get('/', function () {
    return view('pages.login');
});
Route::get('/register_user', function () {
    return view('pages.register');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('pages.home');
    });

    //Route::resource('pizza', PizzaController::class);
    //Route::resource('user', UserController::class);

    ////***********pizza
    Route::get('pizza', ['as' => 'pizza.index', 'uses' => 'PizzaController@index', 'middleware' => ['admin']]);
    Route::get('pizza/create', ['as' => 'pizza.create', 'uses' => 'PizzaController@create', 'middleware' => ['admin']]);
    Route::post('pizza/create', ['as' => 'pizza.store', 'uses' => 'PizzaController@store', 'middleware' => ['admin']]);
    Route::get('pizza/show/{id}', ['as' => 'pizza.show', 'uses' => 'PizzaController@show', 'middleware' => ['admin']]);
    Route::get('pizza/edit/{id}', ['as' => 'pizza.edit', 'uses' => 'PizzaController@edit', 'middleware' => ['admin']]);
    Route::put('pizza_update/{id}', ['as' => 'pizza.update', 'uses' => 'PizzaController@update', 'middleware' => ['admin']]);
    Route::delete('pizza_delete/{id}', ['as' => 'pizza.destroy', 'uses' => 'PizzaController@destroy', 'middleware' => ['admin']]);

    ////***********Users
    Route::get('user', ['as' => 'user.index', 'uses' => 'UserController@index', 'middleware' => ['admin']]);
    Route::get('user/create', ['as' => 'user.create', 'uses' => 'UserController@create', 'middleware' => ['admin']]);
    Route::post('user/create', ['as' => 'user.store', 'uses' => 'UserController@store', 'middleware' => ['admin']]);
    Route::get('user/show/{id}', ['as' => 'user.show', 'uses' => 'UserController@show']);
    Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::put('user_update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update',]);
    Route::delete('user_delete/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['admin']]);

////***********pizza
    Route::get('commande', ['as' => 'commande.index', 'uses' => 'CommandeController@index']);
    Route::get('commande/create', ['as' => 'commande.create', 'uses' => 'CommandeController@create', 'middleware' => ['admin']]);
    Route::post('commande/create', ['as' => 'commande.store', 'uses' => 'CommandeController@store', 'middleware' => ['admin']]);
    Route::get('commande/show/{id}', ['as' => 'commande.show', 'uses' => 'CommandeController@show']);
    Route::get('commande/edit/{id}', ['as' => 'commande.edit', 'uses' => 'CommandeController@edit', 'middleware' => ['pizzaiolo']]);
    Route::put('commande_update/{id}', ['as' => 'commande.update', 'uses' => 'CommandeController@update', 'middleware' => ['pizzaiolo']]);
    Route::get('commande_delete/{id}', ['as' => 'commande.destroy', 'uses' => 'CommandeController@destroy', 'middleware' => ['pizzaiolo']]);


    Route::get('panier',  [ 'uses' => 'CommandeController@panier', 'middleware' => ['user']]);
    Route::delete('delete_panier/{panier_id}',  [ 'uses' => 'CommandeController@delete_panier', 'middleware' => ['user']]);
    Route::post('save_panier',  [ 'uses' => 'CommandeController@save_panier', 'middleware' => ['user']]);

    Route::post('commande/search',  [ 'uses' => 'CommandeController@search', 'middleware' => ['admin']]);
    Route::get('recette',  [ 'uses' => 'CommandeController@recipe', 'middleware' => ['admin']]);
    Route::post('recette/search', 'CommandeController@recipe_search');
});

