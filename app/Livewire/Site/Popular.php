<?php

namespace App\Livewire\Site;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Popular extends Component
{
    public function render()
    {
        $popularArticles = Article::query()
            ->leftJoin('upvote_downvotes', 'articles.id', '=', 'upvote_downvotes.article_id')
            ->select('articles.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(function($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('status', '=', 'published')
            ->orderByDesc('upvote_count')
            ->groupBy(
                'articles.id',
                'articles.title',
                'articles.slug',
                'articles.body',
                'articles.status',
                'articles.published_at',
                'articles.scheduled_for',
                'articles.author_id',
                'articles.editor_id',
                'articles.meta_title',
                'articles.meta_description',
                'articles.deleted_at',
                'articles.created_at',
                'articles.updated_at',
                'articles.ancient_truth',
            )
            ->limit(6)
            ->get();

        return view('livewire.site.popular', compact('popularArticles'));
    }
}
