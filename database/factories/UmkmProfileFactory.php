<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;
use App\Models\UmkmProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UmkmProfile>
 */
class UmkmProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'business_name' => fake()->company(),
            'phone' => fake()->phoneNumber(),
            'nib' => fake()->numerify('############'),
            'business_address' => fake()->address(),
            'category_id' => Category::factory(),
            'region_id' => Region::factory(),
            'scale_id' => Scale::factory(),
        ];
    }
}
