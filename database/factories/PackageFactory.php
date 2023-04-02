<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'weight' => $this->faker->randomFloat(2, 0.1, 20),
            'webshop_id' => Webshop::factory(),
        ];
    }
}
