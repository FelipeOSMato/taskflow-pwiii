<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            ['nome'=>'Gustavo Capas', 'email'=>'guguzinHypes@gmail.com','senha'=> Hash::make('ainpapai123'),'status'=>'Ativo', 'quantiaProjetos'=>2,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['nome'=>'Cabrunco Games', 'email'=>'cabrugamesvrumvrum@gmail.com','senha'=> Hash::make('vrumvrum12'),'status'=>'Ativo', 'quantiaProjetos'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['nome'=>'adm', 'email'=>'adm@gmail.com','senha'=> Hash::make('adm123'),'status'=>'Ativo', 'quantiaProjetos'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]
        ]);
    }
}
