<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_numbers')->insert([
            [ 'number' => 1, 'class_type_id' => 1 ],
            [ 'number' => 2, 'class_type_id' => 1 ],
            [ 'number' => 3, 'class_type_id' => 1 ],
            [ 'number' => 1, 'class_type_id' => 2 ],
            [ 'number' => 2, 'class_type_id' => 2 ],
            [ 'number' => 3, 'class_type_id' => 2 ],
            [ 'number' => 4, 'class_type_id' => 2 ],
            [ 'number' => 1, 'class_type_id' => 3 ],
            [ 'number' => 2, 'class_type_id' => 3 ],
            [ 'number' => 1, 'class_type_id' => 4 ],
            [ 'number' => 1, 'class_type_id' => 5 ],
            [ 'number' => 2, 'class_type_id' => 5 ],
            [ 'number' => 3, 'class_type_id' => 5 ],
            [ 'number' => 4, 'class_type_id' => 5 ],
            [ 'number' => 5, 'class_type_id' => 5 ],
            [ 'number' => 1, 'class_type_id' => 6 ],
            [ 'number' => 2, 'class_type_id' => 6 ],
            [ 'number' => 3, 'class_type_id' => 6 ],
            [ 'number' => 4, 'class_type_id' => 6 ],
            [ 'number' => 5, 'class_type_id' => 6 ]
        ]);
    }
}
