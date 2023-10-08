<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurSocial extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const CREATED_AT = null;

    public const UPDATED_AT = null;

    protected $fillable = ['platform', 'link', 'active'];
}
