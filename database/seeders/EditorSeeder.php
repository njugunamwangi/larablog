<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $editors = User::factory(2)->create();

        foreach($editors as $editor) {
            $editor->assignRole(Role::IS_EDITOR);

            $editor->social()->create([
                'user_id' => $editor->id,
                'facebook' => $editor->slug,
                'instagram' => $editor->slug,
                'linkedin' => $editor->slug,
                'threads' => $editor->slug,
                'x' => $editor->slug,
            ]);
        }
    }
}
