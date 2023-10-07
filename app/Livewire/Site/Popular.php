<?php

namespace App\Livewire\Site;

use App\Models\Article;
use Livewire\Component;

class Popular extends Component
{
    public function render()
    {
        $popularArticles = Article::where('status', '=', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        return view('livewire.site.popular', compact('popularArticles'));
    }
}
