<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        $scholarships = [
            [
                'title' => "Bourse d'Excellence DAAD",
                'description' => "Prise en charge à 100% : billet d'avion, scolarité et allocation mensuelle de 934€. Ouverte aux étudiants camerounais souhaitant poursuivre un Master ou un Doctorat en Allemagne.",
                'university' => 'Université Technique de Munich',
                'country' => 'Allemagne',
                'flag' => '🇩🇪',
                'type' => 'Bourse Complète',
                'status_badge' => 'J-15 avant clôture',
                'level' => 'Master / Doctorat',
                'coverage' => 'Scolarité + Billet + Allocation',
                'deadline' => now()->addDays(15),
                'is_published' => true,
            ],
            [
                'title' => 'Exemption de Frais Majorés',
                'description' => "Réduction importante des droits de scolarité pour les étudiants francophones du Cameroun souhaitant étudier au Québec.",
                'university' => 'Université de Montréal',
                'country' => 'Canada',
                'flag' => '🇨🇦',
                'type' => 'Exemption Partielle',
                'status_badge' => 'Ouvert',
                'level' => 'Licence / Master',
                'coverage' => 'Réduction des frais de scolarité',
                'deadline' => now()->addDays(45),
                'is_published' => true,
            ],
            [
                'title' => 'Bourse CSC Chinoise',
                'description' => "Logement sur le campus, assurance médicale et allocation mensuelle pour les programmes enseignés en anglais.",
                'university' => 'Tsinghua University',
                'country' => 'Chine',
                'flag' => '🇨🇳',
                'type' => 'Bourse Gouvernementale',
                'status_badge' => 'Places limitées',
                'level' => 'Tous Niveaux',
                'coverage' => 'Logement + Assurance + Allocation',
                'deadline' => now()->addDays(30),
                'is_published' => true,
            ],
        ];

        foreach ($scholarships as $data) {
            Scholarship::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
