<?php

namespace Database\Seeders;

use App\Models\Tavoli;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableTavoliSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Tavoli::query()->create([
            array('id' => '10', 'event_id' => '48', 'nome' => 'MATTIA', 'persone' => '15', 'etaMedia' => NULL, 'dettagli' => 'N°11', 'fattoDa' => '1', 'created_by' => '1', 'updated_by' => '2', 'created_at' => '2022-10-19 18:13:53', 'updated_at' => '2022-10-19 20:13:53'),
            array('id' => '2', 'event_id' => '3', 'nome' => 'DALE KLA', 'persone' => '5', 'etaMedia' => NULL, 'dettagli' => NULL, 'fattoDa' => '1', 'created_by' => '2', 'updated_by' => '1', 'created_at' => '2022-10-06 15:09:36', 'updated_at' => '2022-10-06 17:09:36'),
            array('id' => '3', 'event_id' => '9', 'nome' => 'MARCUCCI', 'persone' => '10', 'etaMedia' => NULL, 'dettagli' => NULL, 'fattoDa' => '2', 'created_by' => '1', 'updated_by' => '2', 'created_at' => '2022-10-06 15:09:57', 'updated_at' => '2022-10-06 17:09:57'),
        ]);
    }
}
