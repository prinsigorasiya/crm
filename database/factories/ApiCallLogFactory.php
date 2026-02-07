<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ApiCallLog;

class ApiCallLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ApiCallLog::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'request_call' => fake()->text(),
            'request_fields' => fake()->text(),
            'user_id' => fake()->word(),
            'ip_address' => fake()->word(),
            'response' => fake()->text(),
            'url' => fake()->url(),
        ];
    }
}
