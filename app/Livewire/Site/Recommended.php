<?php

namespace App\Livewire\Site;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Recommended extends Component
{
    public function render()
    {
        $user = auth()->user();

        if ($user) {
            $leftJoin = "(SELECT cp.category_id, cp.article_id FROM upvote_downvotes
                JOIN article_category as cp ON upvote_downvotes.article_id =
                cp.article_id WHERE upvote_downvotes.is_upvote = 1 and upvote_downvotes.user_id = ?) as t";
            $recommendedArticles = Article::query()
                ->leftJoin('article_category as cp', 'articles.id', '=', 'cp.article_id')
                ->leftJoin(DB::raw($leftJoin), function($join) {
                    $join->on('t.category_id', '=', 'cp.category_id')
                        ->on('t.article_id', '<>', 'cp.article_id');
                })
                ->select('articles.*')
                ->where('cp.article_id', '<>',DB::raw('t.article_id'))
                ->setBindings([$user->id])
                ->limit(3)
                ->get();
        } else {
            $recommendedArticles = Article::query()
                ->leftJoin('article_views', 'articles.id', '=', 'article_views.article_id')
                ->select('articles.*', DB::raw('COUNT(article_views.id) as view_count'))
                ->where('status', '=', 'published')
                ->orderByDesc('view_count')
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
                )
                ->limit(3)
                ->get();
        }

        return view('livewire.site.recommended', compact('recommendedArticles'));
    }
}
