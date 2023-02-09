<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TableUsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $data =
            [
                'name' => fake()->firstName(),
                'surname' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => null,
                'username' => 'UtenteProva2',
                'password' => Hash::make('password'),
                'active' => 1,
                'created_at' => now()
            ];
        $user = User::query()->create($data);
        $user->assignRole('pr');
    }
}
