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
        // 科目とユーザーの中間テーブル
        Schema::create('subject_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subject_user', function (Blueprint $table) {
            $table->dropForeign('subject_user_subject_id_foreign');
            $table->dropForeign('subject_user_user_id_foreign');
        });
        Schema::dropIfExists('subject_user');
    }
};
