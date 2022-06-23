<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\AuthController;

Route::post('/client/cadastro', [ClientController::class, 'inserirClient']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('pizza/busca', [PizzaController::class, 'selectPizza']);
Route::get('pizza/lista', [PizzaController::class, 'selectList']);


Route::group(['middleware'=>['auth:sanctum']], function() {
    Route::post('/pizza/registro', [PizzaController::class, 'inserirPizza']);
    Route::post('pizza/cancelar-registro', [PizzaController::class, 'deletePizza']);
    Route::post('/pizza/atualizar-registro', [PizzaController::class, 'updatePizza']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});



