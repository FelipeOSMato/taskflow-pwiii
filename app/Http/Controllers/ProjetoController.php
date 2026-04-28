<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Projeto;
use App\Models\Usuario;

class ProjetoController extends Controller
{
    public function index(){
        $projeto = Projeto::join('usuario', 'projeto.usuario_id', '=', 'usuario.id')
        ->select('projeto.*', 'usuario.nome as usuario_nome')->get();

        $projetoCount = Projeto::select('projeto.*')->count();

        return view('projetos', compact('projeto', 'projetoCount'));
    }

    public function create(){
        return view('projetos');
    }

    public function projeto_select(){
        $usuario = Usuario::all();

        return view('insertProjeto', compact('usuario'));
    }

    public function insert(Request $request){
        $projeto = new Projeto();

        $projeto->nome = $request ->txNome;
        $projeto->descricao = $request ->txDesc;
        $projeto->usuario_id = $request ->txUser;
        $projeto->created_at = date('Y-m-d H:i:s');
        $projeto->updated_at = date('Y-m-d H:i:s');

        $projeto->save();

        return redirect('/projeto');
        
    }
    //API 

    public function indexAPI(){
        $projeto = Projeto::all();

        return $projeto;
    }

    public function insertAPI(Request $request){
        $projeto = new Projeto();

        $projeto->nome = $request ->nome;
        $projeto->descricao = $request ->descricao;
        $projeto->usuario_id = $request ->usuario_id;

        $projeto->save();

        return response()->json($projeto, 201);
    }
}


