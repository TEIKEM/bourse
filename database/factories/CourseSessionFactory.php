<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseSession>
 */
class CourseSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = [
            ['title' => 'Allemand A1 Débutant', 'color' => 'blue'],
            ['title' => 'Allemand A2 Intermédiaire', 'color' => 'blue'],
            ['title' => 'Allemand B1 Intensif', 'color' => 'emerald'],
            ['title' => 'Allemand B2 Avancé', 'color' => 'emerald'],
            ['title' => 'Allemand C1 Supérieur', 'color' => 'indigo'],
            ['title' => 'IELTS Preparation', 'color' => 'indigo'],
            ['title' => 'TOEFL Express', 'color' => 'amber'],
        ];

        $course = $this->faker->randomElement($courses);

        return [
            'title' => $course['title'],
            'location' => $this->faker->randomElement([
                'Centre de Douala (Akwa)',
                'Centre de Yaoundé (Bastos)',
                'Centre de Douala (Bonapriso)',
                'Centre de Yaoundé (Ngoa-Ekelle)',
                'En Ligne & Présentiel'
            ]),
            'duration' => $this->faker->randomElement(['4 semaines', '6 semaines', '8 semaines', '10 semaines', '12 semaines']),
            'start_date' => $this->faker->dateTimeBetween('now', '+3 months')->format('d') . ' ' . $this->faker->randomElement(['Août', 'Septembre', 'Octobre', 'Novembre']),
            'badge_color' => $course['color'],
        ];
    }
}