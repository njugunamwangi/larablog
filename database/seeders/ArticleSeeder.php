<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory(20)
            ->create()
            ->each(function(Article $article) {
                $categories = Category::all()->random(2)->pluck('id')->toArray();
                $locations = Location::all()->random(2)->pluck('id')->toArray();

                $article->categories()->attach($categories);
                $article->locations()->attach($locations);
            });
    }
}
