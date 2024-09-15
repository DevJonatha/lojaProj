<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Atentar-se a documentação do Laravel quando for implementar a Rota resource | Link para consulta: https://laravel.com/docs/11.x/controllers#resource-controllers
//Cria uma rota que corresponde a todos os métodos do CRUD

Route::resource('produtos/produto', ProdutoController::class);
Route::resource('vendas/venda', VendaController::class);
Route::resource('usuarios/usuario', UsuarioController::class);
Route::resource('clientes/cliente', ClienteController::class);