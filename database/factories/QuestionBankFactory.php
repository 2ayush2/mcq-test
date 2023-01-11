<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionBankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $options = ['A', 'B', 'C', 'D', 'E'];
        $type = ['p', 'c'];
        return [
            'question' => $this->faker->sentences(2, true),
            'answer' => $options[rand(0, 4)],
            'options' => json_encode(['A' => $this->faker->word(), 'B' => $this->faker->word(), 'C' => $this->faker->word(), 'D' => $this->faker->word(), 'E' => $this->faker->word()]),
            'type' => $type[rand(0, 1)]
        ];
    }
}
