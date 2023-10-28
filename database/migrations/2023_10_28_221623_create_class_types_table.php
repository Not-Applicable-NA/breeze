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
        Schema::create('class_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // クラスタイプテーブルを削除
        Schema::table('class_types', function (Blueprint $table) {
            $table->dropForeign('class_types_major_id_foreign');
        });
        Schema::dropIfExists('class_types');
    }
};
