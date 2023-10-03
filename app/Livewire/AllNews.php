<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class AllNews extends Component
{
    public function render()
    {
        $articles = Article::where('status', '=', 'published')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('livewire.all-news', compact('articles'));
    }
}
