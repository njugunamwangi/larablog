<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{
    public Article $article;

    public Category $category;

    public Location $location;

    public function render()
    {
        $categories = $this->categories();

        $locations = $this->locations();

        return view('livewire.sidebar', compact('categories', 'locations'));
    }

    public function categories() {
        return Category::query()
            ->leftJoin('article_category', 'categories.id', '=', 'article_category.category_id')
            ->leftJoin('articles', 'article_category.article_id', '=', 'articles.id')
            ->where('articles.status', '=', 'published')
            ->select('categories.category', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id', 'categories.category', 'categories.slug')
            ->orderByDesc('total')
            ->get();
    }

    public function locations() {
        return Location::query()
            ->leftjoin('article_location', 'locations.id', '=', 'article_location.location_id')
            ->leftJoin('articles', 'article_location.article_id', '=', 'articles.id')
            ->where('articles.status', '=', 'published')
            ->select('locations.location', 'locations.slug', DB::raw('count(*) as total'))
            ->groupBy('locations.id', 'locations.location', 'locations.slug')
            ->orderByDesc('total')
            ->get();
    }
}
