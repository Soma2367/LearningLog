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
        Schema::table('teachers', function (Blueprint $table) {
            $table->enum('role', ['teacher', 'student']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->enum('role', ['teacher', 'student']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('role', ['teacher', 'student']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('role', ['teacher', 'student']);
        });
    }
};
