<?php

namespace Database\Factories;

use App\Models\PostCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCompanyFactory extends Factory
{
    protected $model = PostCompany::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
        ];
    }
}
