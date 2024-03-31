<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Article;

class Location extends Component
{
    public \App\Models\Location $location;
    public function render()
    {
        $articles = $this->byLocations();

        return view('livewire.location', compact('articles'))
            ->title($this->location->location);
    }

    public function byLocations() {
        return Article::query()
            ->join('article_location', 'articles.id', '=', 'article_location.article_id')
            ->where('article_location.location_id', '=', $this->location->id)
            ->where('status', '=', 'published')
            ->select('articles.*')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }
}
