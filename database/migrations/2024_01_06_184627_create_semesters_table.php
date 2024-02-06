<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->date('first_start'); // 前期授業開始日
            $table->date('first_first_half_end'); // 前期前半授業終了日
            $table->date('first_second_half_start'); // 前期後半授業開始日
            $table->date('first_end'); // 前期授業終了日
            $table->date('second_start'); // 後期授業開始日
            $table->date('second_first_half_end'); // 後期前半授業終了日
            $table->date('second_second_half_start'); // 後期後半授業開始日
            $table->date('second_end'); // 後期授業終了日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
