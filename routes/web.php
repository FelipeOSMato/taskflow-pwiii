<?php

use Illuminate\Support\Facades\Route;

//Rotas de usuario

Route::get('/inserir-usuario',function(){
    return view('insertUsuario');
});

Route::get('/usuario','App\Http\Controllers\UsuarioController@index');
Route::get('/enviar-usuario','App\Http\Controllers\UsuarioController@create');
Route::post('/criar-usuario','App\Http\Controllers\UsuarioController@insert');
Route::put('/desativar-usuario/{id}','App\Http\Controllers\UsuarioController@desativar');
Route::put('/ativar-usuario/{id}','App\Http\Controllers\UsuarioController@ativar');
Route::put('/editar-usuario/{id}','App\Http\Controllers\UsuarioController@editar');
Route::delete('/excluir-usuario/{id}','App\Http\Controllers\UsuarioController@excluir');


//Rotas das tarefas

Route::get('/inserir-tarefa','App\Http\Controllers\TarefaController@tarefasSelect');
Route::get('/','App\Http\Controllers\TarefaController@index');
Route::get('/enviar-tarefa','App\Http\Controllers\TarefaController@create');
Route::post('/criar-tarefa','App\Http\Controllers\TarefaController@insert');
Route::put('/concluir-tarefa/{id}','App\Http\Controllers\TarefaController@concluir');
Route::put('/editar-tarefa/{id}','App\Http\Controllers\TarefaController@editar');
Route::put('/desfazer-tarefa/{id}','App\Http\Controllers\TarefaController@desfazer');
Route::delete('/excluir-tarefa/{id}','App\Http\Controllers\TarefaController@excluir');

//Rotas dos Projetos

Route::get('/projeto', 'App\Http\Controllers\ProjetoController@index');
Route::get('/enviar-projeto','App\Http\Controllers\ProjetoController@create');
Route::post('/criar-projeto','App\Http\Controllers\ProjetoController@insert');
Route::get('/inserir-projeto','App\Http\Controllers\ProjetoController@projeto_select');
Route::put('/editar-projeto/{id}','App\Http\Controllers\ProjetoController@editar');
Route::delete('/excluir-projeto/{id}','App\Http\Controllers\ProjetoController@excluir');




