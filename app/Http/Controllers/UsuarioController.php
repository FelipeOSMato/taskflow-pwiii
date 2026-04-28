<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();
        $usuarioCount = Usuario::select('usuario.nome')->count();
        return view('usuario', compact('usuario', 'usuarioCount'));
    }

    public function create()
    {
        return view('insertUsuario');
    }

    public function insert(Request $request){
        $usuario = new Usuario();

        $usuario->nome = $request ->txNome;
        $usuario->email = $request ->txEmail;
        $usuario->senha = $request ->txSenha;
        $usuario->created_at = date('Y-m-d H:i:s');
        $usuario->updated_at = date('Y-m-d H:i:s');

        $usuario->save();

        return redirect('/usuario');
    }
    
    //API

    public function indexAPI(){
        $usuario = Usuario::all();

        return $usuario;
    }

    public function insertAPI(Request $request){
        $usuario = new Usuario();

        $usuario->nome = $request ->nome;
        $usuario->email = $request ->email;
        $usuario->senha = $request ->senha;

        $usuario->save();

        return response()->json($usuario, 201);
    }
}