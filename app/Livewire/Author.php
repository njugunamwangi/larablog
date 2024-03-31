<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Author extends Component
{
    public User $user;

    public function render()
    {
        $articles = $this->byAuthor();

        return view('livewire.author', compact('articles'))
            ->title($this->user->name);
    }

    public function byAuthor() {
        return \App\Models\Article::query()
            ->where('author_id', '=', $this->user->id)
            ->where('status', '=', 'published')
            ->paginate(10);
    }
}
