<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            TableRolesSeeder::class,
            TableSuperAdminSeeder::class,
            TableAdminSeeder::class,
            TableUsersSeeder::class,
            TableEventsSeeder::class,
            TableTavoliSeeder::class,
            TableListeSeeder::class,
            TableArchivioSeeder::class,
        ]);
    }
}
