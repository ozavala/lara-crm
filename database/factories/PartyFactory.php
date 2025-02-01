<?php

namespace Database\Factories;

use App\Enums\PartyType;
use App\Models\Party;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartyFactory extends Factory
{
    protected $model = Party::class;

    public function definition(): array
    {
        return [
            'party_type' => fake()->randomElement([PartyType::PERSON, PartyType::ORGANIZATION]),
        ];
    }

    public function person(): static
    {
        return $this->state(fn (array $attributes) => [
            'party_type' => PartyType::PERSON,
        ]);
    }

    public function organization(): static
    {
        return $this->state(fn (array $attributes) => [
            'party_type' => PartyType::ORGANIZATION,
        ]);
    }
}