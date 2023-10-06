<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{
    public Article $article;
    public function render()
    {
        $categories = Category::query()
            ->join('article_category', 'categories.id', '=', 'article_category.category_id')
            ->select('categories.category', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id', 'categories.category', 'categories.slug')
            ->orderByDesc('total')
            ->get();

        return view('livewire.sidebar', compact('categories'));
    }
}
