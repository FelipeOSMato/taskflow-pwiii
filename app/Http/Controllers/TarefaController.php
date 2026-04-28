<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TarefaController extends Controller
{
    public function index(Request $request){

        $tarefas = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
        ->select('tarefa.*', 'projeto.nome as projeto_nome')->get();

        $filtrar = $request->txfiltro;

        if($filtrar == 'pendentes'){
            $tarefas = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->join('usuario', 'projeto.usuario_id', '=', 'usuario.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome', 'usuario.nome as usuario_nome')
            ->where('status','=','Pendente')
            ->get();    
        }elseif($filtrar == 'concluidas'){
            $tarefas = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->join('usuario', 'projeto.usuario_id', '=', 'usuario.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome', 'usuario.nome as usuario_nome')
            ->where('status','=','Concluída')
            ->get();
        }else{
            $tarefas = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->join('usuario', 'projeto.usuario_id', '=', 'usuario.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome', 'usuario.nome as usuario_nome')
            ->get();
        }
        $tarefasTotais = Tarefa::select('tarefa.titulo')->count();
        $tarefasConcluidas = Tarefa::where('status','=','Concluída')->count();
        $tarefasPendentes = Tarefa::where('status','=','Pendente')->count();
        
        return view('home', compact('tarefas', 'tarefasTotais', 'tarefasPendentes', 'tarefasConcluidas'));
    }

    public function tarefasSelect(){
        $projeto = Projeto::all();
        return view('insertTarefa', compact('projeto'));
    }
    public function insert(Request $request){
        $tarefa = new Tarefa();

        $tarefa->titulo = $request ->txNome;
        $tarefa->descricao = $request ->txDesc;
        $tarefa->status = "Pendente";
        $tarefa->data_inicio = date('Y-m-d H:i:s');
        $tarefa->data_fim = $request -> txData;
        $tarefa->projeto_id = $request -> txProjeto;
        $tarefa->created_at = date('Y-m-d H:i:s');
        $tarefa->updated_at = date('Y-m-d H:i:s');

        $tarefa->save();

        return redirect('/');
    }
    public function concluir(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->status = "Concluída";

        $tarefa->save();
        return redirect('/');
    }

    //API
    public function indexApi(){
        $tarefa = Tarefa::all();

        return $tarefa;
    }

    public function insertAPI(Request $request){
        $tarefa = new Tarefa();

        $tarefa->titulo = $request ->titulo;
        $tarefa->descricao = $request ->descricao;
        $tarefa->status = "Pendente";
        $tarefa->data_inicio = date('Y-m-d H:i:s');
        $tarefa->data_fim = $request -> dataFinal;
        $tarefa->projeto_id = $request -> projeto_id;

        $tarefa->save();

        return response()->json($tarefa, 201);
    }
}

