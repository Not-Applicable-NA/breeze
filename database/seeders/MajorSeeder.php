<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('majors')->insert([
            [
                'name' => '先端経営学科',
                'department_id' => 1
            ],
            [
                'name' => 'システム情報学科',
                'department_id' => 1
            ],
            [
                'name' => '医療情報学科',
                'department_id' => 2
            ],
            [
                'name' => '情報メディア学科',
                'department_id' => 3
            ]
        ]);
    }
}
