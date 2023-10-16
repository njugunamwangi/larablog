<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'parent_id',
        'user_id',
        'article_id',
    ];

    public function user() : BelongsTo {

        return $this->belongsTo(User::class);
    }

    public function article() : BelongsTo {

        return $this->belongsTo(Article::class);
    }

    public function parentComment() : BelongsTo {

        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function comments() : HasMany {

        return $this->hasMany(Comment::class, 'parent_id');
    }
}
