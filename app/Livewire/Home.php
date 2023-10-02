<?php

namespace App\Livewire;

use App\Models\Article;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $latestArticles = Article::where('status', '=', 'published')
            ->whereDate('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(2)
            ->get();

        return view('livewire.home', compact('latestArticles'));
    }
}
