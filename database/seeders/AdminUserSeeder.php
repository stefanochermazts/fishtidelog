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
        // Crea un utente amministratore con abbonamento attivo
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@fishtidelog.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        $admin->activateSubscription(); // Attiva abbonamento per l'admin

        // Crea alcuni utenti di test
        $user1 = User::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        $user1->activateSubscription(); // Utente con abbonamento attivo

        $user2 = User::create([
            'name' => 'Giulia Bianchi',
            'email' => 'giulia@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        $user2->initializeTrial(); // Utente con trial attivo

        $this->command->info('Utenti di test creati con successo!');
        $this->command->info('Admin: admin@fishtidelog.com / password');
        $this->command->info('Utente Premium: mario@example.com / password');
        $this->command->info('Utente Free: giulia@example.com / password');
    }
}
