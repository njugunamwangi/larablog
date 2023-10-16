<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use App\Models\ArticleView;
use App\Models\UpvoteDownvote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class ArticleStats extends BaseWidget
{

    public ?Model $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Article Views', ArticleView::query()
                ->where('article_id', '=', $this->record?->id)
                ->count())
                ->icon('heroicon-m-eye'),
            Stat::make('Likes', UpvoteDownvote::query()
                ->where('article_id', '=', $this->record?->id)
                ->where('is_upvote', '=', 1)
                ->count())
                ->icon('heroicon-m-hand-thumb-up'),
            Stat::make('Dislikes', UpvoteDownvote::query()
                ->where('article_id', '=', $this->record?->id)
                ->where('is_upvote', '=', 0)
                ->count())
                ->icon('heroicon-m-hand-thumb-down'),
        ];
    }
}
