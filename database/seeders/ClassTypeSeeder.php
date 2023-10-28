<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_types')->insert([
            [
                'type' => 'A',
                'major_id' => 1
            ],
            [
                'type' => 'C',
                'major_id' => 2
            ],
            [
                'type' => 'K',
                'major_id' => 3
            ],
            [
                'type' => 'L',
                'major_id' => 3
            ],
            [
                'type' => 'E',
                'major_id' => 4
            ],
            [
                'type' => 'F',
                'major_id' => 4
            ]
        ]);
    }
}
