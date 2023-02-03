<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableArchivioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('archivio_tavoli')->insert([
            'id' => '1',
            'nome_stagione' => 'Inverno 2021/22',
            'pdf_tavoli' => 'tavoli-stagione-inverno-2021-22.pdf',
            'pdf_classifica' => 'classifica_tavoli-stagione-inverno-2021-22.pdf',
            'csv_tavoli' => 'tavoli-stagione-inverno-2021-22.csv',
            'dettagli' => 'Dal 23/10/2021 al 14/05/2022'
        ]);
    }
}
