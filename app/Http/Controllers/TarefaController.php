<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{
    public function index()
{
    $tarefas = DB::table('tarefa')
        ->join('usuario', 'tarefa.usuario_id', '=', 'usuario.id')
        ->join('projeto', 'tarefa.projeto_id', '=', 'projeto.id')
        ->select(
            'tarefa.id',
            'tarefa.titulo',
            'tarefa.descricao',
            'tarefa.status',
            'tarefa.data_fim',
            'usuario.nome as usuario_nome',
            'projeto.nome as projeto_nome'
        )
        ->get();

    return view('home', compact('tarefas'));
}
    public function create()
    {
        $projeto = Projeto::all();
        $usuario = Usuario::all();

        return view('insertTarefa', compact('projeto', 'usuario'));
    }

    public function store(Request $request)
    {
        DB::table('tarefa')->insert([
            'titulo' => $request->txNome,
            'descricao' => $request->txDesc,
            'status' => 'Pendente',
            'data_inicio' => now()->toDateString(),
            'data_fim' => $request->txData,
            'usuario_id' => $request->txUser,
            'projeto_id' => $request->txProjeto,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/');
    }
}