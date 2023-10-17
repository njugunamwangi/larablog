<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class Search extends Component
{
    public $search = "";

    public function render()
    {
        $articles = [];

        if (strlen($this->search) >= 1) {
            $articles = Article::query()
                ->where('title', 'like', "%$this->search%")
                ->orWhere('body', 'like', "%$this->search%")
                ->limit(10)
                ->get();
        }

        return view('livewire.search', compact('articles'));
    }


}
