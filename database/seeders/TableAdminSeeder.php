<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TableAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Nicolò',
            'surname' => 'Ausili',
            'email' => 'nicolo.ausili@gstudenti.unicam.it',
            'email_verified_at' => null,
            'username' => 'NikoAuso',
            'password' => Hash::make('12345678'),
            'active' => 1,
            'created_at' => now()
        ]);
        $user->assignRole('admin');
    }
}
