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
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->after('id');
            $table->dropColumn('password');
            $table->string('google_access_token')->after('remember_token');
            $table->string('google_refresh_token')->after('google_access_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->string('password')->after('email_verified_at');
            $table->dropColumn('google_access_token');
            $table->dropColumn('google_refresh_token');
        });
    }
};
