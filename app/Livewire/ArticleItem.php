<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleItem extends Component
{
    public Article $article;
    public function render()
    {
        return view('livewire.article-item');
    }
}
