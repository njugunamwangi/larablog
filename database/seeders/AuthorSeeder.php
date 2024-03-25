<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = User::factory(5)->create();

        foreach($authors as $author) {
            $author->assignRole(Role::IS_AUTHOR);

            $author->social()->create([
                'user_id' => $author->id,
                'facebook' => $author->slug,
                'instagram' => $author->slug,
                'linkedin' => $author->slug,
                'threads' => $author->slug,
                'x' => $author->slug,
            ]);
        }
    }
}
