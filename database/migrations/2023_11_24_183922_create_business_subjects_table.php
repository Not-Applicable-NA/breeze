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
        // 先端経営学科科目
        Schema::create('business_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name'); // 科目名
            $table->integer('credits'); // 単位数
            $table->integer('dividend_grade'); // 配当年次
            $table->boolean('is_obligatory'); // 必修科目か
            $table->string('semester'); // 開講時期
            $table->string('day_of_week_1'); // 開講曜日1
            $table->integer('period_1'); // 開講時限1
            $table->boolean('is_in_a_row_1')->nullable(); // 2コマ連続か
            $table->string('day_of_week_2')->nullable(); // 開講曜日2
            $table->integer('period_2')->nullable(); // 開講時限1
            $table->boolean('is_in_a_row_2')->nullable(); // 2コマ連続か
            $table->string('main_lecture_room'); //主教室
            $table->foreignId('class_id')->constrained()->cascadeOnDelete(); // 対象クラス
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete(); // 担当教員
            $table->text('note')->nullable(); // 備考
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_subjects', function (Blueprint $table) {
            $table->dropForeign('business_subjects_class_id_foreign');
            $table->dropForeign('business_subjects_teacher_id_foreign');
        });
        Schema::dropIfExists('business_subjects');
    }
};
