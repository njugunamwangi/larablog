<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleLocation extends Model
{
    use HasFactory;

    protected $table = 'article_location';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $fillable = ['article_id', 'location_id'];
}
