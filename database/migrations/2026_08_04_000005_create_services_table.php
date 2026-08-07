<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 170)->unique();
            $table->string('icon', 10)->nullable();       // emoji, ex: 🎓
            $table->string('short_description', 255)->nullable(); // pour les cartes
            $table->longText('description')->nullable();  // pour la page détail
            $table->string('cta_label', 100)->nullable();  // ex: "Découvrir les Bourses"
            $table->string('cta_link')->nullable();         // lien externe ou ancre, ex: "#bourses"
            $table->string('image_url')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
