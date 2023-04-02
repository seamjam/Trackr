<?php

namespace Database\Factories;

use App\Models\Webshop;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebshopFactory extends Factory
{
    protected $model = Webshop::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
