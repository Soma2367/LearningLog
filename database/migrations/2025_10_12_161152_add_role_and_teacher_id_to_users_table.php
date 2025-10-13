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
            $table->enum('role', ['teacher', 'student'])
                  ->default('student')
                  ->after('email')
                  ->comment('役割: teacher = 先生, student = 生徒');

            $table->foreignId('teacher_id')
                  ->nullable()
                  ->after('role')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->comment('生徒が所属する先生のID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['role', 'teacher_id']);
        });
    }
};
