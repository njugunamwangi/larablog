<?php

namespace App\Livewire;

use App\Models\ArticleView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Article extends Component
{
    public \App\Models\Article $article;

    public function mount(Request $request) {

        $user = auth()->user();

        ArticleView::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'article_id' => $this->article->id,
            'user_id' => $user ? $user->id : null,
        ]);
    }
    public function render()
    {
        if ($this->article->status !== 'published') {
            throw new NotFoundHttpException;
        }

        $title = $this->article->title;

        $prev = $this->prev();
        $next = $this->next();

        return view('livewire.article', compact('prev', 'next', 'title'))
            ->title($this->article->title);
    }

    public function prev() {
        return \App\Models\Article::query()
            ->where('status', '=', 'published')
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '>', $this->article->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();
    }

    public function next() {
        return \App\Models\Article::query()
            ->where('status', '=', 'published')
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '<', $this->article->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();
    }
}
