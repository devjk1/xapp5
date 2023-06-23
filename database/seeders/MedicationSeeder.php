<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use League\Csv\Reader;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = Reader::createFromPath('./database/csv/medications.csv', 'r');

        LazyCollection::make($reader)
            ->chunk(1000)
            ->each(function ($chunk) {
                $data = $chunk->map(function ($record) {
                    return [
                        'name' => $record[1],
                        'price_default' => random_int(100, 100000),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });
                DB::table('medications')->insert($data->toArray());
            });
    }
}
