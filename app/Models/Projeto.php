<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projeto';

    protected $fillable = [
        'nome',
        'descricao',
        'usuario_id'
    ];
}