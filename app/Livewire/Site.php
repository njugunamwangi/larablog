<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

class Site extends Component
{
    #[Title(null)]
    public function render()
    {
        $categories = $this->categories();

        return view('livewire.site', compact('categories'));
    }

    public function categories() {
        return Category::query()
            ->with(['articles' => function($query) {
                $query->orderByDesc('published_at')
                    ->limit(3);
            }])
            ->whereHas('articles', function($query) {
                $query->where('status', '=', 'published');
            })
            ->select('categories.*')
            ->selectRaw('MAX(articles.published_at) as max_date')
            ->leftJoin('article_category', 'categories.id', '=', 'article_category.category_id')
            ->leftJoin('articles', 'articles.id', '=','article_category.article_id')
            ->orderBy('max_date')
            ->groupBy('categories.id', 'categories.category', 'categories.slug', 'categories.deleted_at', 'categories.created_at', 'categories.updated_at')
            ->limit(3)
            ->get();
    }
}
