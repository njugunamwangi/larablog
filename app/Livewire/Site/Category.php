<?php

namespace App\Livewire\Site;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Category as Categories;

class Category extends Component
{
    public function render()
    {
        $categories = Categories::query()
            ->join('article_category', 'categories.id', '=', 'article_category.category_id')
            ->select('categories.category', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id', 'categories.category', 'categories.slug')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('livewire.site.category', compact('categories'));
    }
}
