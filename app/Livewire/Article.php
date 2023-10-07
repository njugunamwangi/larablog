<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Article extends Component
{
    public \App\Models\Article $article;
    public function render()
    {
        $prev = $this->prev();
        $next = $this->next();

        return view('livewire.article', compact('prev', 'next'));
    }

    public function prev() {
        return \App\Models\Article::query()
            ->where('status', '=', 'published')
            ->whereDate('published_at', '>', $this->article->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();
    }

    public function next() {
        return \App\Models\Article::query()
            ->where('status', '=', 'published')
            ->whereDate('published_at', '<', $this->article->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();
    }
}
