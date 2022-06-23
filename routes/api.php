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

Route::group(['middleware'=>['auth:sanctum']], function() {
    Route::post('/Pizza/Atualizar-Cadastro', [PizzaController::class, 'updatePizza']);
});


Route::post('/Client/Cadastro', [ClientController::class, 'inserirClient']);
Route::post('/Pizza/Cadastro', [PizzaController::class, 'inserirPizza']);
Route::get('/teste', [ClientController::class, 'index']);