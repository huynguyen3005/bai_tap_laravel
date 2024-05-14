<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserhasRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->randomElement(\App\Models\User::pluck('id')->toArray()),
            'role_id' => $this->faker->randomElement(\App\Models\Role::pluck('id')->toArray()),
        ];
    }
}
