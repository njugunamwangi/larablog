<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class UserStats extends BaseWidget
{
    public Model $record;
    protected function getStats(): array
    {
        return [
            Stat::make('Logins', Activity::query()
                ->where('log_name', '=', 'Access')
                ->where('causer_id', '=', $this->record->id)
                ->count()
            )
                ->icon('heroicon-m-arrow-left-on-rectangle'),
            Stat::make('Articles Written', Article::query()
                ->where('author_id', '=', $this->record->id)
                ->count()
            ),
            Stat::make('Articles Edited', Article::query()
                ->where('editor_id', '=', $this->record->id)
                ->count()
            ),
        ];
    }
}
