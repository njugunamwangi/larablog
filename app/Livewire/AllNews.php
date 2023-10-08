<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class AllNews extends Component
{
    public function render()
    {
        $articles = Article::query()
            ->where('status', '=', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('livewire.all-news', compact('articles'));
    }
}
