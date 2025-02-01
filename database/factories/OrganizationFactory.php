<?php

namespace Database\Factories;

use App\Models\Party;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'party_id' => Party::factory()->organization()->create()->id,
            'name' => fake()->company(),
            'tax_id' => fake()->numerify('##-#######'),
            'website' => fake()->url(),
        ];
    }
} 