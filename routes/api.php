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
Route::get('/count-tarefa', 'App\Http\Controllers\TarefaController@countsApi');
Route::get('/listar-tarefa/{titulo}', 'App\Http\Controllers\TarefaController@tarefaEspAPI');
Route::post('/criar-tarefa', 'App\Http\Controllers\TarefaController@insertAPI');
Route::put('/atualizar-tarefa/{id}','App\Http\Controllers\TarefaController@atualizarAPI');
Route::put('/concluir-tarefa/{id}','App\Http\Controllers\TarefaController@concluirAPI');
Route::put('/desfazer-tarefa/{id}','App\Http\Controllers\TarefaController@desfazerAPI');
Route::delete('/excluir-tarefa/{id}','App\Http\Controllers\TarefaController@excluirAPI');

//Usuarios

Route::get('/usuario', 'App\Http\Controllers\UsuarioController@indexAPI');
Route::get('/listar-id-usuario/{nome}', 'App\Http\Controllers\UsuarioController@listarIDAPI');
Route::post('/criar-usuario', 'App\Http\Controllers\UsuarioController@insertAPI');
Route::put('/ativar-usuario/{id}','App\Http\Controllers\UsuarioController@ativarAPI');
Route::put('/desativar-usuario/{id}','App\Http\Controllers\UsuarioController@desativarAPI');
Route::put('/atualizar-usuario/{id}','App\Http\Controllers\UsuarioController@atualizarAPI');

Route::delete('/excluir-usuario/{id}','App\Http\Controllers\UsuarioController@excluirAPI');

//Projeto

Route::get('/projeto', 'App\Http\Controllers\ProjetoController@indexAPI');
Route::post('/criar-projeto', 'App\Http\Controllers\ProjetoController@insertAPI');
Route::put('/atualizar-projeto/{id}', 'App\Http\Controllers\ProjetoController@atualizarAPI');
Route::delete('/excluir-projeto/{id}','App\Http\Controllers\ProjetoController@excluirAPI');
