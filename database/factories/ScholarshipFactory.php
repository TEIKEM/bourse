<?php

namespace Database\Factories;

use App\Models\Scholarship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Scholarship>
 */
class ScholarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement([
                "Bourse d'Excellence DAAD",
                "Exemption de Frais Majorés",
                "Bourse CSC Chinoise",
                "Bourse Eiffel d'Excellence"
            ]),
            'type' => $this->faker->randomElement(['Bourse Complète', 'Exemption Partielle', 'Bourse Gouvernementale']),
            'status_badge' => $this->faker->randomElement(['J-15 avant clôture', 'Ouvert', 'Places limitées']),
            'badge_color' => $this->faker->randomElement(['blue', 'emerald', 'amber']),
            'university' => $this->faker->company() . ' University',
            'country' => $this->faker->randomElement(['Allemagne', 'Canada', 'Chine', 'France']),
            'flag' => $this->faker->randomElement(['🇩🇪', '🇨🇦', '🇨🇳', '🇫🇷']),
            'description' => 'Prise en charge partielle ou totale des frais de scolarité et logement pour étudiants internationaux.',
            'level' => $this->faker->randomElement(['Licence / Master', 'Master / Doctorat', 'Tous Niveaux']),
            'apply_link' => '#',
        ];
    }
}
