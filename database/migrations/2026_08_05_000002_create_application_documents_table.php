<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();
            // Relation polymorphe : peut appartenir à une ScholarshipApplication OU une CourseEnrollment
            $table->morphs('documentable');
            $table->string('label', 100); // ex: "Diplôme", "Pièce d'identité", "CV"
            $table->string('original_name');
            $table->string('path');
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('size')->nullable(); // en octets
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_documents');
    }
};
