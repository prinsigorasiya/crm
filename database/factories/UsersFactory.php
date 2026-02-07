<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use App\Models\Users;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => fake()->dateTime(),
            'mobile' => fake()->word(),
            'profile_image' => fake()->word(),
            'owner_approval' => fake()->randomElement(["Yes","No"]),
            'description' => fake()->text(),
            'address' => fake()->text(),
            'country' => fake()->country(),
            'state' => fake()->text(),
            'city' => fake()->city(),
            'status' => fake()->randomElement(["Active","Inactive"]),
            'created_id' => User::factory(),
            'updated_id' => User::factory(),
            'deleted_id' => User::factory(),
        ];
    }
}
