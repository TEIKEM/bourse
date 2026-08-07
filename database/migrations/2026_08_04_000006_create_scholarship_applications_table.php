<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('scholarship_id')->constrained()->cascadeOnDelete();
            $table->text('motivation')->nullable();
            $table->enum('status', ['pending', 'under_review', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();

            // Un étudiant ne peut postuler qu'une seule fois à la même bourse
            $table->unique(['user_id', 'scholarship_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
};
