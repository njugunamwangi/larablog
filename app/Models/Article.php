<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'status',
        'published_at',
        'scheduled_for',
        'author_id',
        'editor_id',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function image() {
        return $this->getMedia('articles')->isEmpty() ? null : $this->getMedia('articles')->first()->getUrl();
    }

    public function categories() : BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function locations() : BelongsToMany {
        return $this->belongsToMany(Location::class);
    }

    public function author() : BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor() : BelongsTo {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function shortBody($words = 30) : string {
        return Str::words(strip_tags($this->body), $words);
    }

    public function getFormattedDate() {
        return $this->published_at->format('F jS, Y');
    }

    public function humanReadTime() : Attribute {
        return new Attribute(
            get: function($value, $attributes) {
                $words = \Illuminate\Support\Str::wordCount(strip_tags($attributes['body']));
                $minutes = ceil($words/200);

                return $minutes . ' ' . str('min')->plural($minutes) . ' read, ' . $words . ' ' . str('words')->plural($words);
            }
        );
    }
}
