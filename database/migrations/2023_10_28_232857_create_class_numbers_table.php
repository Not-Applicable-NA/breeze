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
        Schema::create('class_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->foreignId('class_type_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // クラス番号テーブルを削除
        Schema::table('class_numbers', function (Blueprint $table) {
            $table->dropForeign('class_numbers_class_type_id_foreign');
        });
        Schema::dropIfExists('class_numbers');
    }
};
