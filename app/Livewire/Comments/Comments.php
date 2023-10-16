<?php

namespace App\Livewire\Comments;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public Article $article;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh'
    ];

    public function mount(Article $article) {
        $this->article = $article;
    }

    public function render()
    {
        $comments = $this->selectComments();

        return view('livewire.comments.comments', compact('comments'));
    }

    public function selectComments() {
        return Comment::query()
            ->where('article_id', '=', $this->article->id)
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }
}
