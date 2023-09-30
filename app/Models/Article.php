<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
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
}
