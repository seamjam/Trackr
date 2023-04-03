<?php

namespace Database\Factories;

use App\Models\PickupRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Package;

class PickupRequestFactory extends Factory
{
    protected $model = PickupRequest::class;

    public function definition()
    {
        return [
            'package_id' => Package::factory(),
            'pickup_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
        ];
    }
}
