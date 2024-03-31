<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class Category extends Component
{
    public \App\Models\Category $category;
    public function render()
    {
        $articles = $this->byCategory();

        return view('livewire.category', compact('articles'))
            ->title($this->category->category);
    }

    public function byCategory() {
        return Article::query()
            ->join('article_category', 'articles.id', '=', 'article_category.article_id')
            ->where('article_category.category_id', '=', $this->category->id)
            ->where('status', '=', 'published')
            ->select('articles.*')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }
}
