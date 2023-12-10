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
        // 科目と担当教員の中間テーブル
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_teacher', function (Blueprint $table) {
            $table->dropForeign('subject_teacher_teacher_id_foreign');
            $table->dropForeign('subject_teacher_subject_id_foreign');
        });
        Schema::dropIfExists('subject_teacher');
    }
};
