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
        // 科目と対象クラスの中間テーブル
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_subjects', function (Blueprint $table) {
            $table->dropForeign('class_subjects_subject_id_foreign');
            $table->dropForeign('class_subjects_class_id_foreign');
        });
        Schema::dropIfExists('class_subjects');
    }
};
