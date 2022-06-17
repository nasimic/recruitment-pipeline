<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status_id' => Status::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->word(),
            'min_salary' => $this->faker->numberBetween(1000, 1500),
            'max_salary' => $this->faker->numberBetween(4500, 5000),
            'linkedin_url' => "https://linkedin.com/".$this->faker->slug(),
            'cv' => null
        ];
    }
}
