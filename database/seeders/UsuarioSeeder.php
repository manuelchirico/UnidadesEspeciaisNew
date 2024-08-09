<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nome' => 'Admin',
            'tipo' => 'admin',
            'numero_celular' => '123456789',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
        ]);
    }
}
