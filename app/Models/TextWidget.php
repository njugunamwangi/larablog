<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TextWidget extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'title',
        'content',
        'active'
    ];

    public static function getTitle(string $key) : string {

        $widget = Cache::get('text-widget-'.$key, function() use($key) {
            return TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });

        if ($widget) {
            return $widget->title;
        }

        return '';
    }

    public static function getContent(string $key) : string {
        $widget = Cache::get('text-widget-'.$key, function() use($key) {
            return TextWidget::query()
                ->where('key', '=', $key)
                ->where('active', '=', 1)
                ->first();
        });

        if ($widget) {
            return $widget->content;
        }

        return '';
    }
}
