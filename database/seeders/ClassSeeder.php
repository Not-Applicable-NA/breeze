<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            [ 'name' => 'A1', 'major_id' => 1 ],
            [ 'name' => 'A2', 'major_id' => 1 ],
            [ 'name' => 'A3', 'major_id' => 1 ],
            [ 'name' => 'C1', 'major_id' => 2 ],
            [ 'name' => 'C2', 'major_id' => 2 ],
            [ 'name' => 'C3', 'major_id' => 2 ],
            [ 'name' => 'C4', 'major_id' => 2 ],
            [ 'name' => 'K1', 'major_id' => 3 ],
            [ 'name' => 'K2', 'major_id' => 3 ],
            [ 'name' => 'L1', 'major_id' => 3 ],
            [ 'name' => 'E1', 'major_id' => 4 ],
            [ 'name' => 'E2', 'major_id' => 4 ],
            [ 'name' => 'E3', 'major_id' => 4 ],
            [ 'name' => 'E4', 'major_id' => 4 ],
            [ 'name' => 'E5', 'major_id' => 4 ],
            [ 'name' => 'F1', 'major_id' => 4 ],
            [ 'name' => 'F2', 'major_id' => 4 ],
            [ 'name' => 'F3', 'major_id' => 4 ],
            [ 'name' => 'F4', 'major_id' => 4 ],
            [ 'name' => 'F5', 'major_id' => 4 ]
        ]);
    }
}
