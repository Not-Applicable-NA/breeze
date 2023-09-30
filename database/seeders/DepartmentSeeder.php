<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [ 'name' => '経営情報学部' ],
            [ 'name' => '医療情報学部' ],
            [ 'name' => '情報メディア学部' ]
        ]);
    }
}
