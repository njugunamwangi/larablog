<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    public const IS_ADMIN = 1;
    public const IS_EDITOR = 2;
    public const IS_AUTHOR = 3;
    public const IS_MANAGER = 4;
    public const IS_DEV = 5;
}
