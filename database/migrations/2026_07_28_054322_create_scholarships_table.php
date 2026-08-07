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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // Bourse Complète, Exemption Partielle...
            $table->string('status_badge'); // J-15 avant clôture, Ouvert...
            $table->string('badge_color')->default('blue'); // blue, emerald, amber
            $table->string('university');
            $table->string('country');
            $table->string('flag'); // 🇩🇪, 🇨🇦, 🇨🇳
            $table->text('description');
            $table->string('level'); // Master / Doctorat, Tous Niveaux...
            $table->string('apply_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
