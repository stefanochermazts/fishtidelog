<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un utente amministratore
        User::create([
            'name' => 'Admin',
            'email' => 'admin@fishtidelog.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_premium' => true,
            'premium_until' => now()->addYear(),
        ]);

        // Crea alcuni utenti di test
        User::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_premium' => true,
            'premium_until' => now()->addMonths(6),
        ]);

        User::create([
            'name' => 'Giulia Bianchi',
            'email' => 'giulia@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_premium' => false,
        ]);

        $this->command->info('Utenti di test creati con successo!');
        $this->command->info('Admin: admin@fishtidelog.com / password');
        $this->command->info('Utente Premium: mario@example.com / password');
        $this->command->info('Utente Free: giulia@example.com / password');
    }
}
