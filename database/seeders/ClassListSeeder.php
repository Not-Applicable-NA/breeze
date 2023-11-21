<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_lists')->insert([
            [ 'class' => 'A1', 'major_id' => 1 ],
            [ 'class' => 'A2', 'major_id' => 1 ],
            [ 'class' => 'A3', 'major_id' => 1 ],
            [ 'class' => 'C1', 'major_id' => 2 ],
            [ 'class' => 'C2', 'major_id' => 2 ],
            [ 'class' => 'C3', 'major_id' => 2 ],
            [ 'class' => 'C4', 'major_id' => 2 ],
            [ 'class' => 'K1', 'major_id' => 3 ],
            [ 'class' => 'K2', 'major_id' => 3 ],
            [ 'class' => 'L1', 'major_id' => 3 ],
            [ 'class' => 'E1', 'major_id' => 4 ],
            [ 'class' => 'E2', 'major_id' => 4 ],
            [ 'class' => 'E3', 'major_id' => 4 ],
            [ 'class' => 'E4', 'major_id' => 4 ],
            [ 'class' => 'E5', 'major_id' => 4 ],
            [ 'class' => 'F1', 'major_id' => 4 ],
            [ 'class' => 'F2', 'major_id' => 4 ],
            [ 'class' => 'F3', 'major_id' => 4 ],
            [ 'class' => 'F4', 'major_id' => 4 ],
            [ 'class' => 'F5', 'major_id' => 4 ]
        ]);
    }
}
