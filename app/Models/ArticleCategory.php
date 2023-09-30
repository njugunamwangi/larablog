<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_category';

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $fillable = ['article_id', 'category_id'];
}
