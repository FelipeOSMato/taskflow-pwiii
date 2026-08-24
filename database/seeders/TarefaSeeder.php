<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tarefa')->insert([
            ['titulo'=>'Apis do Sistema', 'descricao'=>'Montar apis para funcionalidade do sistema','status'=>'Pendente','data_inicio'=>date('Y-m-d'), 'data_fim'=>'2026-09-21','projeto_id'=>1,'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')],
            ['titulo'=>'Requisitos do Sistema', 'descricao'=>'Montar requisitos para funcionalidade do sistema de dados','status'=>'Concluída','data_inicio'=>'2026-06-12', 'data_fim'=>'2026-06-21','projeto_id'=>2,'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=> date('Y-m-d H:i:s')]
        ]);
    }
}
