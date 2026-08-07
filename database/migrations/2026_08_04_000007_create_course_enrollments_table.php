<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_session_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();

            // Un étudiant ne peut s'inscrire qu'une seule fois à la même session
            $table->unique(['user_id', 'course_session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_enrollments');
    }
};
