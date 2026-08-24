<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projeto')->insert([
            ['nome'=>'Projeto de APIs','descricao'=>'Criação de APIs para o aplicativo','quantiaTarefas'=>1,'usuario_id'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['nome'=>'Sistema de dados','descricao'=>'Criação de um Sistema para registro de dados','quantiaTarefas'=>1,'usuario_id'=>1,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ]);
    }
}
