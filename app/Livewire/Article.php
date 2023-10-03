<?php

namespace App\Livewire;

use Livewire\Component;

class Article extends Component
{
    public \App\Models\Article $article;
    public function render()
    {
        return view('livewire.article');
    }
}
