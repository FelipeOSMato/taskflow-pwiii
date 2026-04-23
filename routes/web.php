<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index']);

Route::get('/usuario', [UsuarioController::class, 'index']);
Route::get('/inserir-usuario', [UsuarioController::class, 'create']);
Route::post('/criar-usuario', [UsuarioController::class, 'store']);

Route::get('/inserir-tarefa', [TarefaController::class, 'create']);
Route::post('/criar-tarefa', [TarefaController::class, 'store']);