<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Projeto;

class ProjetoController extends Controller
{
    public function index(){
        $projeto = Projeto::all();

        return view('projeto')->with('projeto', $projeto);
    }
}
