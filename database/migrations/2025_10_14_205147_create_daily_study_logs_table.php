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
        Schema::create('daily_study_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->comment('生徒ID');
            $table->string('title');
            $table->text('content');
            $table->date('study_date');
            $table->unsignedTinyInteger('progress_rating')
                  ->nullable()
                  ->comment('5段階評価');
            $table->text('teacher_feedback')->nullable();
            $table->timestamp('teacher_viewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_study_logs');
    }
};
