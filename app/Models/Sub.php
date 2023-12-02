<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Sub extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $guarded = [];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('sub')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
