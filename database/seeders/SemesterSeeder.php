<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carbon = Carbon::today();
        DB::table('semesters')->insert([
            [
                'first_start' => $carbon->toDateString(),
                'first_first_half_end' => $carbon->toDateString(),
                'first_second_half_start' => $carbon->toDateString(),
                'first_end' => $carbon->toDateString(),
                'second_start' => $carbon->toDateString(),
                'second_first_half_end' => $carbon->toDateString(),
                'second_second_half_start' => $carbon->toDateString(),
                'second_end' => $carbon->toDateString(),
            ]
        ]);
    }
}
