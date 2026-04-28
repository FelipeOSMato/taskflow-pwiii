<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Tarefas

Route::get('/tarefa', 'App\Http\Controllers\TarefaController@indexAPI');
Route::post('/tarefa', 'App\Http\Controllers\TarefaController@insertAPI');

//Usuarios

Route::get('/usuario', 'App\Http\Controllers\UsuarioController@indexAPI');
Route::post('/usuario', 'App\Http\Controllers\UsuarioController@insertAPI');

//Projeto

Route::get('/projeto', 'App\Http\Controllers\ProjetoController@indexAPI');
Route::post('/projeto', 'App\Http\Controllers\ProjetoController@insertAPI');
