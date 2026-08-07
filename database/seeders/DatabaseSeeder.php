<?php

namespace Database\Seeders;

use App\Models\CourseSession;
use App\Models\Scholarship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Générer 6 bourses de test
        Scholarship::factory(6)->create();

        // Générer les prochaines sessions de langues
        CourseSession::create([
            'title' => 'Allemand B1 Intensive',
            'location' => 'Centre de Douala (Akwa)',
            'duration' => '8 semaines',
            'start_date' => '15 Août',
            'badge_color' => 'blue'
        ]);

        CourseSession::create([
            'title' => 'Allemand A1 Débutant',
            'location' => 'Centre de Yaoundé (Bastos)',
            'duration' => '10 semaines',
            'start_date' => '01 Septembre',
            'badge_color' => 'blue'
        ]);

        CourseSession::create([
            'title' => 'IELTS Preparation',
            'location' => 'En Ligne & Présentiel',
            'duration' => '4 semaines',
            'start_date' => '10 Septembre',
            'badge_color' => 'indigo'
        ]);
        $this->call([
    ScholarshipSeeder::class,
    LanguageCourseSeeder::class,
    ServiceSeeder::class,
]);
    }
}
