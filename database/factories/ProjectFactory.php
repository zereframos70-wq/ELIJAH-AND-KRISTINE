<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'portfolio' => fake()->randomElement(['fabia', 'ramos', 'both']),
            'title' => fake()->unique()->sentence(3),
            'description' => fake()->paragraph(),
            'tech_stack' => fake()->words(3),
            'project_url' => fake()->url(),
            'repository_url' => fake()->url(),
            'image_path' => null,
            'completed_at' => fake()->date(),
            'display_order' => fake()->numberBetween(0, 100),
        ];
    }
}
