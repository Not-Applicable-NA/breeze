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
        Schema::create('class_lists', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->foreignId('major_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_lists', function (Blueprint $table) {
            $table->dropForeign('class_lists_major_id_foreign');
        });
        Schema::dropIfExists('class_lists');
    }
};
