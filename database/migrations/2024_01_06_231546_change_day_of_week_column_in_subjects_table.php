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
        Schema::table('subjects', function (Blueprint $table) {
            // 曜日カラムを数値に変更
            $table->integer('day_of_week_1')->change();
            $table->integer('day_of_week_2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            // 元に戻す
            $table->string('day_of_week_1')->change();
            $table->string('day_of_week_2')->nullable()->change();
        });
    }
};
