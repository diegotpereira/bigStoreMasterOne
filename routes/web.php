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

Route::get('/{any}', function () {
    return view('landing');
})->where('any', '.*');


Route::post('login', 'UserController@login');;
Route::post('register', 'UserController@register');

Route::get('/produtos', 'ProdutoController@index');
Route::post('/upload-file', 'ProdutoController@uploadFile');
Route::get('/produtos/{produto}', 'ProdutoController@show');

route::group(['middleware' => 'auth:api'], function() {
    Route::get('/users', 'UserController@index');
    Route::get('/users/{user}', 'UserController@show');
    Route::patch('users/{user}', 'UserController@update');
    Route::get('users/{user}/pedidos', 'UserController@mostrarPedidos');

    Route::patch('produtos/{produto}/unidades/add', 'ProdutoController@atualizarUnidades');

    Route::patch('pedidos/{pedido}/entragar', 'PedidoController@entregarPedido');
    Route::resource('/pedidos', 'PedidoController');
    Route::resource('/produtos', 'ProdutoController')->except(['index', 'show']);
});