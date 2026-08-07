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
        {
    Schema::table('users', function (Blueprint $table) {
        // Par défaut, un utilisateur créé est un 'student' (étudiant)
        // Rôles possibles ex: 'student', 'admin', 'teacher'
        $table->string('role')->default('student')->after('email');
    });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
