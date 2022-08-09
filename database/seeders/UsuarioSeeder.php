<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'nestor.chela@espoch.edu.ec'
        ])->assignRole('Administrador');
        User::create([
            'email' => 'talia.zarate@espoch.edu.ec'
        ])->assignRole('Tecnico de Convenios');
    }
}
