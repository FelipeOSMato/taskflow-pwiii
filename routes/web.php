<?php

use Illuminate\Support\Facades\Route;

//Rotas de usuario

Route::get('/inserir-usuario',function(){
    return view('insertUsuario');
});

Route::get('/usuario','App\Http\Controllers\UsuarioController@index');

Route::get('/enviar-usuario','App\Http\Controllers\UsuarioController@create');

Route::post('/criar-usuario','App\Http\Controllers\UsuarioController@insert');


//Rotas das tarefas

Route::get('/inserir-tarefa','App\Http\Controllers\TarefaController@tarefasSelect');

Route::get('/','App\Http\Controllers\TarefaController@index');

Route::get('/enviar-tarefa','App\Http\Controllers\TarefaController@create');

Route::post('/criar-tarefa','App\Http\Controllers\TarefaController@insert');

Route::put('/concluir-tarefa/{id}','App\Http\Controllers\TarefaController@concluir');

//Rotas dos Projetos

Route::get('/projeto', 'App\Http\Controllers\ProjetoController@index');

Route::get('/enviar-projeto','App\Http\Controllers\ProjetoController@create');

Route::post('/criar-projeto','App\Http\Controllers\ProjetoController@insert');

Route::get('/inserir-projeto','App\Http\Controllers\ProjetoController@projeto_select');




