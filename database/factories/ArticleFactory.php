<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->sentence(),
            'slug' => Str::slug($title),
            'body' => fake()->paragraph(),
            'author_id' => fake()->randomElement(User::role(Role::IS_AUTHOR)->pluck('id')),
            'editor_id' => fake()->randomElement(User::role(Role::IS_EDITOR)->pluck('id')),
        ];
    }
}
