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
        Schema::create('teacher_subject', function (Blueprint $table) {
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
        Schema::table('teacher_subject', function (Blueprint $table) {
            $table->dropForeign('teacher_subject_teacher_id_foreign');
            $table->dropForeign('teacher_subject_subject_id_foreign');
        });
        Schema::dropIfExists('teacher_subject');
    }
};
