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
        Schema::create('student_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                  ->constrained('teachers')
                  ->cascadeOnDelete();
            $table->string('code', 10)
                  ->unique()
                  ->comment('招待コード');
            $table->boolean('used')
                  ->default(false);
            $table->timestamp('used_at')
                  ->nullable();
            $table->foreignId('student_id')
                  ->nullable()
                  ->constrained('students')
                  ->nullOnDelete();
            $table->timestamp('expires_at')
                  ->nullable();
            $table->timestamps();
            $table->index(['code', 'used']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_invitations');
    }
};
