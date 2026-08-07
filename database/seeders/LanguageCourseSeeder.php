<?php

namespace Database\Seeders;

use App\Models\CourseSession;
use Illuminate\Database\Seeder;

class LanguageCourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Allemand B1 Intensive',
                'language' => 'Allemand',
                'level' => 'B1',
                'description' => "Session intensive de niveau B1, préparation aux examens du Goethe-Institut. Cours du jour et du soir disponibles, avec simulations d'examens oraux et écrits chaque fin de module.",
                'mode' => 'Présentiel',
                'location' => 'Centre de Douala (Akwa)',
                'address' => 'Immeuble ABC, 2ème étage',
                'duration' => '8 semaines',
                'schedule' => '08h00 - 12h00',
                'start_date' => '15 Août',
                'session_date' => now()->addDays(11),
                'capacity' => 15,
                'price' => 85000,
                'badge_color' => 'blue',
                'status_badge' => 'Places limitées',
                'is_published' => true,
            ],
            [
                'title' => 'Allemand A1 Débutant',
                'language' => 'Allemand',
                'level' => 'A1',
                'description' => "Cours pour grands débutants, aucune connaissance préalable requise. Support de cours audio et livrets de vocabulaire inclus.",
                'mode' => 'Présentiel',
                'location' => 'Centre de Yaoundé (Bastos)',
                'address' => 'Immeuble Le Progrès',
                'duration' => '10 semaines',
                'schedule' => '14h00 - 17h00',
                'start_date' => '1 Septembre',
                'session_date' => now()->addDays(28),
                'capacity' => 15,
                'price' => 65000,
                'badge_color' => 'emerald',
                'status_badge' => 'Ouvert',
                'is_published' => true,
            ],
            [
                'title' => 'IELTS Preparation',
                'language' => 'Anglais',
                'level' => 'IELTS',
                'description' => "Préparation intensive au test IELTS, format hybride combinant sessions en ligne et présentiel. Simulations d'examens régulières.",
                'mode' => 'Hybride',
                'location' => 'En Ligne & Présentiel',
                'address' => null,
                'duration' => '4 semaines',
                'schedule' => 'Flexible',
                'start_date' => '10 Septembre',
                'session_date' => now()->addDays(37),
                'capacity' => 20,
                'price' => 55000,
                'badge_color' => 'indigo',
                'status_badge' => 'Nouveau',
                'is_published' => true,
            ],
        ];

        foreach ($courses as $data) {
            CourseSession::create($data);
        }
    }
}
