<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_sessions', function (Blueprint $table) {
            if (! Schema::hasColumn('course_sessions', 'language')) {
                $table->string('language', 50)->nullable()->after('title'); // Allemand, Anglais...
            }
            if (! Schema::hasColumn('course_sessions', 'level')) {
                $table->string('level', 50)->nullable()->after('language'); // A1, B1, IELTS...
            }
            if (! Schema::hasColumn('course_sessions', 'description')) {
                $table->longText('description')->nullable()->after('level');
            }
            if (! Schema::hasColumn('course_sessions', 'mode')) {
                $table->string('mode', 50)->default('Présentiel')->after('location'); // Présentiel, En ligne, Hybride
            }
            if (! Schema::hasColumn('course_sessions', 'schedule')) {
                $table->string('schedule', 100)->nullable()->after('duration'); // ex: "08h00 - 12h00"
            }
            if (! Schema::hasColumn('course_sessions', 'address')) {
                $table->string('address', 150)->nullable()->after('location');
            }
            if (! Schema::hasColumn('course_sessions', 'session_date')) {
                // Vraie date, séparée du champ texte "start_date" existant, pour trier/filtrer correctement
                $table->date('session_date')->nullable()->after('start_date');
            }
            if (! Schema::hasColumn('course_sessions', 'capacity')) {
                $table->unsignedInteger('capacity')->nullable()->after('session_date');
            }
            if (! Schema::hasColumn('course_sessions', 'price')) {
                $table->decimal('price', 12, 2)->nullable()->after('capacity');
            }
            if (! Schema::hasColumn('course_sessions', 'status_badge')) {
                $table->string('status_badge', 100)->nullable()->after('badge_color'); // ex: "Places limitées"
            }
            if (! Schema::hasColumn('course_sessions', 'image_url')) {
                $table->string('image_url')->nullable()->after('status_badge');
            }
            if (! Schema::hasColumn('course_sessions', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('image_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('course_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'language', 'level', 'description', 'mode', 'schedule',
                'address', 'session_date', 'capacity', 'price',
                'status_badge', 'image_url', 'is_published',
            ]);
        });
    }
};
