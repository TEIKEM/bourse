<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Bourses & Admissions',
                'slug' => Str::slug('Bourses & Admissions'),
                'icon' => '🎓',
                'short_description' => "Sélection de bourses, montage du dossier académique et négociation d'exemptions de frais de scolarité.",
                'description' => "Notre équipe identifie les bourses les plus adaptées à votre profil académique et vous accompagne à chaque étape : constitution du dossier, lettres de motivation, traduction des relevés de notes, et suivi des candidatures jusqu'à la décision finale.",
                'cta_label' => 'Découvrir les Bourses',
                'cta_link' => '/bourses',
                'order' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'École de Langues',
                'slug' => Str::slug('École de Langues'),
                'icon' => '🗣️',
                'short_description' => "Formations intensives en Allemand (A1 à C1) et Anglais (IELTS/TOEFL) dispensées par nos enseignants certifiés.",
                'description' => "Nos centres de Douala et Yaoundé proposent des sessions intensives adaptées à tous les niveaux, avec suivi individuel, examens blancs réguliers et préparation ciblée aux diplômes officiels (Goethe-Institut, ÖSD, IELTS, TOEFL).",
                'cta_label' => 'Voir les sessions',
                'cta_link' => '/cours-de-langues',
                'order' => 2,
                'is_published' => true,
            ],
            [
                'title' => 'Visa & Installation',
                'slug' => Str::slug('Visa & Installation'),
                'icon' => '📁',
                'short_description' => "Assistance pour compte bloqué, assurance voyage, réservation de logement et préparation aux entretiens consulaires.",
                'description' => "Une fois votre admission obtenue, nous vous accompagnons dans toutes les démarches administratives : ouverture de compte bloqué, souscription d'une assurance santé internationale, recherche de logement étudiant et simulation d'entretien d'ambassade.",
                'cta_label' => 'Nous contacter',
                'cta_link' => '/#services',
                'order' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
