<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableListeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('liste')->insert([
            array('list_id' => '3', 'event_id' => '20', 'name' => 'CRISTINA', 'surname' => 'BORDONI', 'quantity' => '3', 'entered' => '0', 'fatto_da' => '2', 'created_at' => '2022-11-07 18:01:05', 'created_by' => '2'),
            array('list_id' => '4', 'event_id' => '20', 'name' => 'MICHELE', 'surname' => 'MOSCA', 'quantity' => '4', 'entered' => '0', 'fatto_da' => '2', 'created_at' => '2022-11-07 18:02:43', 'created_by' => '2'),
            array('list_id' => '5', 'event_id' => '20', 'name' => 'LEONARDO', 'surname' => 'MALDINI', 'quantity' => '8', 'entered' => '0', 'fatto_da' => '1', 'created_at' => '2022-11-07 19:06:00', 'created_by' => '2'),
            array('list_id' => '6', 'event_id' => '20', 'name' => 'CLARISSA', 'surname' => 'MALTEMPI', 'quantity' => '7', 'entered' => '0', 'fatto_da' => '1', 'created_at' => '2022-11-08 13:00:27', 'created_by' => '2'),
            array('list_id' => '7', 'event_id' => '20', 'name' => 'GIOELE', 'surname' => 'LATINI', 'quantity' => '10', 'entered' => '0', 'fatto_da' => '1', 'created_at' => '2022-11-08 17:56:20', 'created_by' => '2'),
            array('list_id' => '8', 'event_id' => '20', 'name' => 'JUDY', 'surname' => 'TIRANTI', 'quantity' => '3', 'entered' => '0', 'fatto_da' => '1', 'created_at' => '2022-11-08 19:57:03', 'created_by' => '2'),
            array('list_id' => '9', 'event_id' => '20', 'name' => 'FRANCESCO', 'surname' => 'BELELLI', 'quantity' => '2', 'entered' => '0', 'fatto_da' => '2', 'created_at' => '2022-11-09 16:16:11', 'created_by' => '2'),
            array('list_id' => '10', 'event_id' => '21', 'name' => 'ELISA', 'surname' => 'FRANCOLETTI', 'quantity' => '3', 'entered' => '0', 'fatto_da' => '2', 'created_at' => '2022-11-09 18:49:24', 'created_by' => '2'),
            array('list_id' => '11', 'event_id' => '21', 'name' => 'Riccardo', 'surname' => 'Taddei', 'quantity' => '4', 'entered' => '0', 'fatto_da' => '1', 'created_at' => '2022-11-09 20:42:59', 'created_by' => '2')
        ]);
    }
}
