<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use App\Models\Tarefa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\ListCommand\PropertyEnumerator;

use function Laravel\Prompts\select;

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
            ->where('tarefa.status','=','Pendente')
            ->get();    
        }elseif($filtrar == 'concluidas'){
            $tarefas = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->join('usuario', 'projeto.usuario_id', '=', 'usuario.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome', 'usuario.nome as usuario_nome')
            ->where('tarefa.status','=','Concluída')
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

        $projeto = Projeto::findOrFail($request->txProjeto);

        $contarTarefas = Tarefa::where('projeto_id', '=', $projeto->id)->count();

        $projeto->quantiaTarefas= $contarTarefas;

        $projeto->save();

        return redirect('/');
    }
    public function concluir(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->status = "Concluída";

        $tarefa->save();
        return redirect('/');
    }
    public function desfazer(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->status = "Pendente";

        $tarefa->save();
        return redirect('/');
    }
    public function editar(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->titulo = $request -> txNome;
        $tarefa->descricao = $request ->txDesc;
        $tarefa->data_fim = $request -> txData;

        $tarefa->save();

        return redirect('/');
    }
    public function excluir(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);
        $projeto = Projeto::findOrFail($tarefa->projeto_id);

        Tarefa::where('id', '=', $id)->delete();

        $contarTarefas = Tarefa::where('projeto_id', '=', $projeto->id)->count();

        $projeto->quantiaTarefas= $contarTarefas;

        $projeto->save();

        return redirect('/');
    }

    //API
    public function indexApi(){
        $tarefa = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome')
            ->get();

        return $tarefa;
    }

    //API de listar uma tarefa específica
    public function tarefaEspAPI(String $titulo){
        $tarefa = Tarefa::join('projeto','tarefa.projeto_id','=','projeto.id')
            ->select('tarefa.*', 'projeto.nome as projeto_nome')
            ->where('tarefa.titulo','=',$titulo)
            ->get();

        return $tarefa;
    }
    public function countsApi(){
        $tarefaCounts = Tarefa::select('tarefa.titulo as tarefas_totais')->count();
        $tarefasConcluidas = Tarefa::where('status', '=', 'Concluída')->count();
        $tarefasPendentes = Tarefa::where('status', '=', 'Pendente')->count();

        return response()->json([
            'tarefas_totais' => $tarefaCounts,
            'tarefas_concluidas' => $tarefasConcluidas,
            'tarefas_pendentes' => $tarefasPendentes
        ]);
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

        $projeto = Projeto::findOrFail($request->projeto_id);

        $contarTarefas = Tarefa::where('projeto_id', '=', $projeto->id)->count();

        $projeto->quantiaTarefas= $contarTarefas;

        $projeto->save();


        return response()->json($tarefa, 201);
    }
    public function atualizarAPI(Request $request, string $id){
        $validarDados = $request -> validate([
            'titulo' => 'min:3',
            'descricao' => 'max:200',
            'status' => 'in:Pendente,Concluída'
        ]);
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->data_fim = $request -> data_fim;
        $tarefa->projeto_id = $request -> projeto_id;

        $tarefa->update($validarDados);

        return response()->json($tarefa, 201);
    }
    //API para concluir uma tarefa
    public function concluirAPI(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->status = "Concluída";

        $tarefa->save();
        return response()->json($tarefa, 201);
    }
    //API para desfazer uma tarefa
    public function desfazerAPI(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);

        $tarefa->status = "Pendente";

        $tarefa->save();
        return response()->json($tarefa, 201);
    }


    public function excluirAPI(Request $request, string $id){
        $tarefa = Tarefa::findOrFail($id);
        $projeto = Projeto::findOrFail($tarefa->projeto_id);

        Tarefa::where('id', '=', $id)->delete();

        $contarTarefas = Tarefa::where('projeto_id', '=', $projeto->id)->count();

        $projeto->quantiaTarefas= $contarTarefas;

        $projeto->save();
        
        return response()->json([
            'message'=>"Tarefa excluída",
            'code'=>200
        ]);
    }
}

