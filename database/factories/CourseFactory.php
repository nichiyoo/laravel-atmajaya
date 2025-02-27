<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class CourseFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'code' => fake()->unique()->regexify('[A-Z]{3} [0-9]{3}'),
      'description' => fake()->sentence(),
      'credit' => fake()->numberBetween(2, 4),
      'section' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
    ];
  }
}
