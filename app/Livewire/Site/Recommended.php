<?php

namespace App\Livewire\Site;

use App\Models\Article;
use Livewire\Component;

class Recommended extends Component
{
    public function render()
    {
        $recommendedArticles = Article::where('status', '=', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('livewire.site.recommended', compact('recommendedArticles'));
    }
}
