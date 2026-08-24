<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            ['nome'=>'Gustavo Capas', 'email'=>'guguzinHypes@gmail.com','senha'=>'ainpapai123','status'=>'Ativo', 'quantiaProjetos'=>2,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['nome'=>'Cabrunco Games', 'email'=>'cabrugamesvrumvrum@gmail.com','senha'=>'vrumvrum12','status'=>'Ativo', 'quantiaProjetos'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ]);
    }
}
