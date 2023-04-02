<?php

namespace Database\Factories;

use App\Models\PickupRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PickupRequestFactory extends Factory
{
    protected $model = PickupRequest::class;

    public function definition()
    {
        return [
            'package_id' => Package::factory(),
            'pickup_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'status' => $this->faker->randomElement(['requested', 'confirmed', 'picked_up', 'canceled']),
        ];
    }
}
