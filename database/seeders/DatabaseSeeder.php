<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria um perfil de administrador
        User::factory()->create([
            'name' => 'Admin',
            'cpf' => '12345678900',
            'email' => 'admin@ticto.com.br',
            'password' => bcrypt('12345678'),
            'position' => 'Admin',
            'birth_date' => '2000-01-01',
            'cep' => '12345678',
            'address' => 'Admin Street, 123',
        ]);

        // Cria um perfil de funcionário
        User::factory()->create([
            'name' => 'Empregado',
            'cpf' => '98765432100',
            'email' => 'employee@ticto.com.br',
            'password' => bcrypt('12345678'),
            'position' => 'Empregado',
            'birth_date' => '1990-01-01',
            'cep' => '87654321',
            'address' => 'Employee Street, 456',
            'manager_id' => 1, // Referencia o administrador como gerente
        ]);
    }
}
