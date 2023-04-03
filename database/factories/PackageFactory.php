<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Webshop;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'tracking_number' => $this->faker->word(),
            'webshop_id' => Webshop::factory(),
        ];
    }
}
