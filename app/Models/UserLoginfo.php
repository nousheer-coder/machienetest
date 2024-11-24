<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginfo extends Model
{
    protected $fillable = [
        'user_id',
        'logged_at',
    ];
    protected $table="user_loginfo";
}
