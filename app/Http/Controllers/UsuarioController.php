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
        return view('usuario', compact('usuario'));
    }

    public function create()
    {
        return view('insertUsuario');
    }

    public function store(Request $request)
    {
        DB::table('usuario')->insert([
            'nome' => $request->txNome,
            'email' => $request->txEmail,
            'senha' => $request->txSenha,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/usuario');
    }
}