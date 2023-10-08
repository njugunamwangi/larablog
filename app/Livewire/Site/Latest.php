<?php

namespace App\Livewire\Site;

use App\Models\Article;
use Livewire\Component;

class Latest extends Component
{
    public function render()
    {
        $latestArticles = Article::query()
            ->where('status', '=', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(2)
            ->get();

        return view('livewire.site.latest', compact('latestArticles'));
    }
}
